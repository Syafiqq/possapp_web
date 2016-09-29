/*  All Control
================================================== */
$(document).ready(function(){

    $('#main-menu').metisMenu();
    $(window).bind("load resize", function() {
        if ($(this).width() < 768) {
            $('div.sidebar-collapse').addClass('collapse');
        } else {
            $('div.sidebar-collapse').removeClass('collapse');
        }
    });
    $('ul.nav-second-level').find('li.active-submenu').parent('ul.nav').addClass('collapse in').parent('li').addClass('active').children('a').first().addClass('active-menu');

	$("#login").addClass("animated fadeInDown");

  

	/*  Tiny Mce
  ================================================== */
  tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak fullscreen",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern table"
    ],
    toolbar1: "undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | link preview fullscreen",
    menubar: false,
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
  });

	/*  Sidebar
  ================================================== */
  $('ul.nav-second-level').find('li.active-submenu').parent('ul.nav').addClass('collapse in').parent('li').addClass('active').children('a').first().addClass('active-menu');
  
    $("#tambah").click(function() {
        $("#submit").html('<input type="submit" name="tambah" value="Simpan">');
        $("#status").val("tambah");
        $("#stokarea").show();
        $("#hargaarea").addClass("setengah");
        $("#stokarea").removeClass("setengah");
        $("#tambahstokarea").css("display",'none');
        $("#barcodekode").removeAttr('readOnly');
        $("#barcodekode").val("");
        $("#namabarang").val("");
        $("#letakbarang").val("");
        $("#hargabarang").val("");
        $("#spesifikasi").val("");
        $("#stokbarang").val("");
        tinyMCE.activeEditor.setContent("");
        $("#barcodekode").removeAttr('readOnly');
        $("#tambahstok").removeAttr('required');
        $("#namabarang").removeAttr('readOnly');
        $("#letakbarang").removeAttr('readOnly');
        $("#hargabarang").removeAttr('readOnly');
        $("#spesifikasi").removeAttr('readOnly');
        $("#stokbarang").removeAttr('readOnly');
        $("#keta").html("Form Barang");
        tinymce.activeEditor.getBody().setAttribute('contenteditable', true);
    });
    $("#transsubmit").click(function() {
      alert("yes"); 
      // var table = $("#table_dibeli tbody");

      // table.find('tr').each(function (i) {
      //     var tds = $(this).find('td');
      //         productId = tds.eq(0).text();
      //         product = tds.eq(1).text();
      //         Quantity = tds.eq(2).text();
      //     // do something with productId, product, Quantity
      //      alert('Row ' + (i + 1) + ':\nId: ' + productId
      //         + '\nProduct: ' + product
      //         + '\nQuantity: ' + Quantity);
      // })  
    });
    $("#tambahtransaksi").click(function() {
        $("#keta").html("Form Transaksi");
        $("#submit").html('<input type="submit" name="tambah" id="transsubmit" value="Simpan">');
    });
    $("#submit-barang").click(function() {
      var bk = $("#barcodekode").val();
      var total = $("#total").val();
      if (total=="") {
        alert("Total Barang Boleh Kosong!");
        $('#total').focus();
      }else {
        $.ajax({
              url:"application/view/transaksi/check.php",
              type:"POST",
              data:{tot: total,barcode:bk },
              success:function(kena){
                  if (kena != 0 && kena != 1) {
                    var hasil = kena.split(";");
                    var dt = $("#detail").val();
                     var isi = "<tr><td hidden>"+hasil[0]+"</td><td>"+hasil[1]+"</td><td class='total_brg'>"+total+"</td><td>"+hasil[2].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")+"</td><td  class='tot_harga' hidden>"+(hasil[2]*total)+"</td><td>"+(hasil[2]*total).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")+"</td><td class='hps-brg'><a href='#' class='dell'>Hapus</a></tr>";
                      dt += hasil[0]+";"+total+";"+(hasil[2]*total)+"-";
                      $("#detail").val(dt);
                      $("#isi_table").append(isi);
                      $("#barcodekode").val("");
                      $("#total").val("");
                        getTotal(); 
                  }else if(kena==1) {
                    alert("barang yang anda minta dibawah dari stok yang ada silakan tambahkan stok barang terlebih dahulu");
                  }else {
                    alert("barang tidak ditemukan");
                    $("#barcodekode").val("");
                    $("#total").val("");
                    $("#barcodekode").focus();
                  }
                  $(".dell").on("click", function(){
                    var total = $("#totalbarang").val();
                    var harga = $("#totalbayar").val();
                    var tr = $(this).closest('tr');
                    total = total - tr.find(".total_brg").text();
                    harga = harga - tr.find(".tot_harga").text();
                    tr.fadeOut(400, function(){
                        tr.remove();
                    });
                    $("#totalbarang").val(total);
                    $("#totalbayar").val(harga);
                  })
              },
              error:function(meleset){
                  alert(meleset);
              }
          });
      getTotal(); 
    }
  })
  $("#form-area").submit(function(e){
    var pembeli = $('#pembeli').val();
    var total_barang = $('#totalbarang').val();
    if (pembeli == "") {
      e.preventDefault();
      alert("Nama pembeli harus diisi!");
      $("#pembeli").focus();
    }
    if (total_barang == "") {
      e.preventDefault();
      alert("Barang yang dibeli minimal 1 barang!");
      $("#barcodekode").focus(); 
    }else if(total_barang == 0) {
      e.preventDefault();
      alert("Barang yang dibeli minimal 1 barang!");
      $("#barcodekode").focus(); 
    }
  })
  $(".dell").on("click",".hps-brg", function(){
    // var total = $("#totalbarang").val();
    // var harga = $("#totalbayar").val();
    alert("aa");
    // var tr = $(this).closest('tr');
    // total = total - tr.find(".total_brg").text();
    // harga = harga - tr.find(".tot_harga").text();
    // tr.fadeOut(400, function(){
    //     tr.remove();
    // });
    // $("#totalbarang").val(total);
    // $("#totalbayar").val(harga);
  })
    //      $(this).on("click", function(){
    //     var total = $("#totalbarang").val();
    //     var harga = $("#totalbayar").val();
    //         var tr = $(this).closest('tr');
    //         total = total - tr.find(".total_brg").text();
    //         harga = harga - tr.find(".tot_harga").text();
    //         tr.fadeOut(400, function(){
    //             tr.remove();
    //         });
    //         $("#totalbarang").val(total);
    //         $("#totalbayar").val(harga);
    //         return false;
    //     });
    // });
    function getTotal(){
        var harga = 0;
        var total = 0;
        $('.tot_harga').each(function(){
            harga += parseFloat(this.innerHTML)
        });
        $('.total_brg').each(function(){
            total += parseFloat(this.innerHTML)
        });
        $('#totalbayar').val(harga);
        $('#totalbarang').val(total);
    }
    $("#stok").click(function() {
      $("#submit").html('<input type="submit" name="stok" value="Simpan">');      
      $("#status").val("check");
      $("#keta").html("Form Barang");
      $("#barcodekode").removeAttr('readOnly');
      $("#namabarang").attr('readOnly','true');
      $("#letakbarang").attr('readOnly','true');
      $("#hargabarang").attr('readOnly','true');
      $("#hargabarang").attr('readOnly','true');
      $("#stokbarang").attr('readOnly','true');
      tinyMCE.activeEditor.setContent("");
      $("#barcodekode").removeAttr('readOnly');
      $("#tambahstokarea").css("display",'block');
      $("#stokarea").addClass("setengah");
      $("#tambahstok").attr('required','true');
      $("#barcodekode").val("");
      $("#namabarang").val("");
      $("#letakbarang").val("");
      $("#hargabarang").val("");
      $("#spesifikasi").val("");
      $("#stokbarang").val("");
      tinymce.activeEditor.getBody().setAttribute('contenteditable', false);
    });

    $(".edit-barang").click(function(){
      var id = $(this).attr('id');   
      $(".selected").removeClass("selected");
      $(this).closest("tr").addClass("selected");
      $("#submit").html('<input type="submit" name="edit" value="Simpan">');      
      var id_barcode = $("#table_area .selected #barcode").html();
      var nama = $("#table_area .selected #nama").html();
      var letak = $("#table_area .selected #letak").html();
      var harga = $("#table_area .selected #harga").html();
      var stok = $("#table_area .selected #stok").html();
      tinymce.activeEditor.getBody().setAttribute('contenteditable', true);
      var isi = $("#table_area .selected #spesifikasi").html();
      $("#keta").html("Form Barang");
      $(".md-modal").addClass("md-show");
      $("#status").val("edit");
      $("#stokbarang").attr('readOnly','true');
      $("#barcodekode").val(id_barcode.trim());
      $("#barcodekode").attr('readOnly','true');
      $("#stokarea").removeClass("setengah");
      $("#tambahstokarea").css("display",'none');
      $("#namabarang").val(nama);
      $("#letakbarang").val(letak);
      $("#hargabarang").val(harga);
      $("#stokbarang").val(stok);
      $("#namabarang").removeAttr('readOnly');
      $("#letakbarang").removeAttr('readOnly');
      $("#hargabarang").removeAttr('readOnly');
      $("#spesifikasi").removeAttr('readOnly');
      $("#tambahstok").removeAttr('required');
      tinyMCE.activeEditor.setContent(isi);
    });
     function ChangeUrl(page, url) {
        if (typeof (history.pushState) != "undefined") {
            var obj = { Page: page, Url: url };
            history.pushState(obj, obj.Page, obj.Url);
        } else {
            alert("Browser does not support HTML5.");
        }
    };


  /*  Pagination
  ================================================== */
    
  //how much items per page to show
  var show_per_page = 10; 
  //getting the amount of elements inside content div
  var number_of_items = $('#isi_table').children().size();
  var number_of_cards = $('#kartu').children().size();
  //calculate the number of pages we are going to have
  var number_of_pages = Math.ceil(number_of_items/show_per_page);
  var number_of_cardpages = Math.ceil(number_of_cards/show_per_page);
  //set the value of our hidden input fields
  $('#current_page').val(0);
  $('#show_per_page').val(show_per_page);
  
  //now when we got all we need for the navigation let's make it '
  
  /* 
  what are we going to have in the navigation?
    - link to previous page
    - links to specific pages
    - link to next page
  */
  var navigation_html = '<a class="previous_link" href="javascript:previous();">Prev</a>';
  var current_link = 0;
  while(number_of_pages > current_link || number_of_cardpages > current_link){
    navigation_html += '<a class="page_link" href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>';
    current_link++;
  };
  navigation_html += '<a class="next_link" href="javascript:next();">Next</a>';
  
    if (number_of_items > 10 || number_of_cards > 10) {
        $('#page_navigation').html(navigation_html);
    };

    //add active_page class to the first page link
    $('#page_navigation .page_link:first').addClass('active_page');
    
    //hide all the elements inside content div
    $('#isi_table').children().css('display', 'none');
    $('#kartu').children().css('display', 'none');
    
    //and show the first n (show_per_page) elements
    $('#isi_table').children().slice(0, show_per_page).css('display', 'table-row');
    $('#kartu').children().slice(0, show_per_page).css('display', 'table-row');
 });

    (function( $ ){
  $.fn.beautyTables = function() {
    var table = this;
    var string_fill = false;
    this.on('keydown', function(event) {
    var target = event.target;
    var tr = $(target).closest("tr");
    var col = $(target).closest("td");
    if (target.tagName.toUpperCase() == 'INPUT'){
      if (event.shiftKey === true){
        switch(event.keyCode) {
          case 37: // left arrow
            col.prev().children("input[type=text]").focus();
            break;
          case 39: // right arrow
            col.next().children("input[type=text]").focus();
            break;
          case 40: // down arrow
            if (string_fill==false){
              tr.next().find('td:eq('+col.index()+') input[type=text]').focus();
            }
            break;
          case 38: // up arrow
            if (string_fill==false){
              tr.prev().find('td:eq('+col.index()+') input[type=text]').focus();
            }
            break;
        }
      }
      if (event.ctrlKey === true){
        switch(event.keyCode) {
          case 37: // left arrow
            tr.find('td:eq(1)').find("input[type=text]").focus();
            break;
          case 39: // right arrow
            tr.find('td:last-child').find("input[type=text]").focus();
            break;
        case 40: // down arrow
          if (string_fill==false){
            table.find('tr:last-child td:eq('+col.index()+') input[type=text]').focus();
          }
          break;
        case 38: // up arrow
          if (string_fill==false){
            table.find('tr:eq(1) td:eq('+col.index()+') input[type=text]').focus();
          }
            break;
        }
      }
      if (event.keyCode == 13 || event.keyCode == 9 ) {
        event.preventDefault();
        col.next().find("input[type=text]").focus();
      }
      if (string_fill==false){
        if (event.keyCode == 34) {
          event.preventDefault();
          table.find('tr:last-child td:last-child').find("input[type=text]").focus();}
        if (event.keyCode == 33) {
          event.preventDefault();
          table.find('tr:eq(1) td:eq(1)').find("input[type=text]").focus();}
      }
    }
    });
    table.find("input[type=text]").each(function(){
      $(this).on('blur', function(event){
      var target = event.target;
      var col = $(target).parents("td");
      if(table.find("input[name=string-fill]").prop("checked")==true) {
        col.nextAll().find("input[type=text]").each(function() {
          $(this).val($(target).val());
        });
      }
    });
  })
};
})( jQuery );
//
// Beauty Hover Plugin (backlight row and col when cell in mouseover)
//
//
(function( $ ){
  $.fn.beautyHover = function() {
    var table = this;
    table.on('mouseover','td', function() {
      var idx = $(this).index();
      var rows = $(this).closest('table').find('tr');
      rows.each(function(){
        $(this).find('td:eq('+idx+')').addClass('beauty-hover');
      });
    })
    .on('mouseleave','td', function(e) {
      var idx = $(this).index();
      var rows = $(this).closest('table').find('tr');
      rows.each(function(){
        $(this).find('td:eq('+idx+')').removeClass('beauty-hover');
      });
    });
  };
})( jQuery );


function previous(){
  
  new_page = parseInt($('#current_page').val()) - 1;
  //if there is an item before the current active link run the function
  if($('.active_page').prev('.page_link').length==true){
    go_to_page(new_page);
  }
  
}

function next(){
  new_page = parseInt($('#current_page').val()) + 1;
  //if there is an item after the current active link run the function
  if (isNaN(new_page)) {
    new_page=0;
  };
  if($('.active_page').next('.page_link').length==true){
    go_to_page(new_page);
  }
  
}
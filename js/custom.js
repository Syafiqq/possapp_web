$("#barcodekode").focusout(function(){
    var bk = $("#barcodekode").val();
    var st = $("#status").val();
    if (bk != "") {
        $.ajax({
            url:"application/view/barang/checkbarcode.php",
            type:"POST",
            data:{status:st,barcode:bk },
            success:function(kena){
                if (kena == bk){
                    alert("barcode ini \"" + kena + "\" sudah terdaftar!");
                    $("#barcodekode").focus();
                }
                if (st="check" && kena.indexOf(';')>0) {
                    var hasil = kena.split(";");
                    $("#namabarang").val(hasil[1]);
                    $("#letakbarang").val(hasil[2]);
                    $("#hargabarang").val(hasil[4]);
                    $("#stokbarang").val(hasil[5]);
                    tinyMCE.activeEditor.setContent(hasil[3]);
                };
            },
            error:function(meleset){
                alert(meleset);
            }
        })
    };
})
var specialKeys = new Array();
specialKeys.push(8); //Backspace
function IsNumeric(selector) {
    $(selector).keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;

        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    })
}
IsNumeric("#barcodekode");
IsNumeric("#hargabarang");
IsNumeric("#stokbarang");
IsNumeric("#stokbarang");
IsNumeric("#total");
$("#totalbarang").attr('readOnly','true');
$("#totalbayar").attr('readOnly','true');
setTimeout(function(){
    $('#play').trigger("click");
},0);
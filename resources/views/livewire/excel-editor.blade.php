<div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/luckysheet/dist/plugins/css/pluginsCss.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/luckysheet/dist/plugins/plugins.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/luckysheet/dist/css/luckysheet.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/luckysheet/dist/assets/iconfont/iconfont.css">

    <style>
        .editor-container{
            width:100%;
            height:calc(100vh - 150px);
            background:#fff;
            border-radius:12px;
            overflow:hidden;
        }

        #luckysheet{
            width:100%;
            height:100%;
        }
    </style>

    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center">

                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary me-3">
                    <i class="ti ti-arrow-left"></i>
                    Kembali
                </a>

                <h5 class="mb-0 fw-bold">
                    {{ $upload->nama_asli }}
                </h5>

            </div>

            <button
                id="btn-save"
                class="btn btn-primary">

                <i class="ti ti-device-floppy me-1"></i>

                Simpan Perubahan

            </button>

        </div>
    </div>

    <div class="editor-container" wire:ignore>

        <div id="luckysheet"></div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/luckysheet/dist/plugins/js/plugin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luckysheet/dist/luckysheet.umd.js"></script>

    <script>

        document.addEventListener('livewire:navigated', initSheet);
        document.addEventListener('DOMContentLoaded', initSheet);

        function initSheet(){

    if(typeof luckysheet === "undefined"){
        console.log("Luckysheet belum siap");
        return;
    }

    if(document.querySelector(".luckysheet-grid-window")){
        luckysheet.destroy();
    }

    const celldata=@json($celData);

    luckysheet.create({

        container:"luckysheet",

        title:"DataFlow",

        lang:"en",

        allowEdit:true,

        editable:true,

        showtoolbar:true,

        showinfobar:false,

        showsheetbar:true,

        sheetFormulaBar:true,

        enableAddRow:true,

        enableAddCol:true,

        enableAddBackTop:true,

        row:100,

        column:26,

        hook:{
            workbookCreateAfter:function(){
                console.log("Luckysheet Ready");
            }
        },

        data:[{
            name:"Sheet1",
            index:"0",
            status:1,
            order:0,
            celldata:celldata,
            config:{}
        }]

    });

}
        window.addEventListener("load",function(){

    setTimeout(function(){

        initSheet();

    },500);

});

document.addEventListener("livewire:navigated",function(){

    setTimeout(function(){

        initSheet();

    },500);

});
document.getElementById("btn-save").addEventListener("click", async function () {

    let btn = this;

    btn.disabled = true;
    btn.innerHTML = "Menyimpan...";

    try{

        let file = luckysheet.getLuckysheetfile();

        let celldata = file[0].celldata;

        await @this.call('saveExcel', JSON.stringify(celldata));

        alert("Berhasil disimpan");

    }catch(e){

        console.error(e);

        alert("Gagal menyimpan");

    }

    btn.disabled = false;

    btn.innerHTML = '<i class="ti ti-device-floppy me-1"></i> Simpan Perubahan';

});

    </script>

</div>
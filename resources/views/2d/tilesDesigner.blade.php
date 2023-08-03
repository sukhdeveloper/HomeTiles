
<div id="tilesDesigner" class="modal fade">

    <div class="td-panel">
        {{--<div class="td-x-close-btn">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>--}}


        <div class="td-blank-tiles-block">
<div class="td-logo">
                <a href="#" title="Logo">
                    <img src="/storage/company/1pbnAaFvGpL3TLUgHPOIQCWYVyMEzu4kkC7HGmhH.png" alt="Company logo">
                </a>
            </div>
			<p style="text-align: center">Only for Desktop</p>

            <h4>Select Category:</h4>
            <select class="form-control" id="category"></select>
            <h4>Enter Tile Code:</h4>
            <div class="search_tile_wrapper"><input type="text" id="search_tile" onchange="gettileCode(this.value)" onclick="searchtitleValue(this.value)" placeholder="Search" class="form-control search_tile_code" list="list-tilecode" name="search"/>
            
            <datalist id="list-tilecode" name="list-tilecode" >
                
            </datalist>
        </div>
            <div id="td-blank-tiles"></div>
        </div>

        <div class="td-paint-block riser-block-wrap">
            <!-- <canvas id="editWrapCanvas" style="display: none;"></canvas> -->
            <div id="edit-wrap">
                <canvas id="td-custom-tile"> </canvas>
            </div>

            <div id="colors-container"></div>
        </div>

        <div class="td-buttons-block">
            {{--<div class="redo-and-undo-btns">
                <button id="titleDesignerUndoBtn" class="btns-wrap"><img src="img/undo.png"></button>
                <button id="titleDesignerRedoBtn" class="btns-wrap"><img src="img/redo.png"></button>
            </div>--}}
            <button id="tilesDesignerClearBtn" disabled>Clear</button> 
            <button id="tilesDesignerSaveBtn" disabled>Save</button>
            <button id="tilesDesignerDownloadBtn" disabled>Download</button>
            
            <div class="td-tile-info td-tile-info-header">Pattern Name:</div>
            <div id="tilesDesignerPatternName" class="td-tile-info">-</div>
            <div class="td-tile-info td-tile-info-header">Color Combination:</div>
            <div id="tilesDesignerUsedColors" class="td-tile-info">-</div>
        </div>

        <div class="td-grid-block">
            <canvas id="tilesGrid"></canvas>
        </div>

        <div class="td-saved-tiles-block">
            <img src="/img/icons/arrowLeft.png" alt="Left arrow" class="td-saved-tiles-left-arrow">
            <div id="tilesDesignerSavedTiles"></div>
            <img src="/img/icons/arrowRight.png" alt="Right arrow" class="td-saved-tiles-right-arrow">
        </div>
    </div>
</div>

<script>
    var tilesDesignerShowOnload = @if (config('app.tiles_designer_show_onload')) true @else false @endIf ;
    var TilesDesignerColorsCatalog = [
        // pantoneCode - COLOR PANTONE CODE UNCOATED
        // hex - HEX COLOR REFERENCE
        // mosaicoNumber - MOSAICO COLOR NUMBER REFERENCE
        // name - MOSAICO COLOR NAME REFERENCE
        { 'pantoneCode': '', 'hex': '3B2259', 'mosaicoNumber': '100', 'name': '100 Dark Violet' },
        { 'pantoneCode': '', 'hex': '4A2747', 'mosaicoNumber': '098', 'name': '098 Plum' },
        { 'pantoneCode': '', 'hex': '4E3CB4', 'mosaicoNumber': '083', 'name': '083 Violet' },
        { 'pantoneCode': '', 'hex': '64466C', 'mosaicoNumber': '101', 'name': '101 Grape' },
        { 'pantoneCode': '', 'hex': '9B85B9', 'mosaicoNumber': '099', 'name': '099 Light Violet' },
        { 'pantoneCode': '', 'hex': '9DAACD', 'mosaicoNumber': '113', 'name': '124 Lilac' },
        { 'pantoneCode': '', 'hex': 'BBC3D0', 'mosaicoNumber': '113', 'name': '123 Dusk' },
        { 'pantoneCode': '', 'hex': 'C0E3F0', 'mosaicoNumber': '097', 'name': '097 Snow Blue ' },
        { 'pantoneCode': '', 'hex': '7DC3D8', 'mosaicoNumber': '087', 'name': '087 Light Blue ' },
        { 'pantoneCode': '', 'hex': '4CACD5', 'mosaicoNumber': '086', 'name': '086 Baby Blue' },
        { 'pantoneCode': '', 'hex': '4C82CA', 'mosaicoNumber': '089', 'name': '089 Violet Blue ' },
        { 'pantoneCode': '', 'hex': '126BA5', 'mosaicoNumber': '080', 'name': '080 Electric Blue' },
        { 'pantoneCode': '', 'hex': '134368', 'mosaicoNumber': '113', 'name': '121 Navy Blue' },
        { 'pantoneCode': '', 'hex': '97A9B3', 'mosaicoNumber': '113', 'name': '119 Dove Gray' },
        { 'pantoneCode': '', 'hex': '6A878F', 'mosaicoNumber': '113', 'name': '120 Blue Gray' },
        { 'pantoneCode': '', 'hex': '19435C', 'mosaicoNumber': '113', 'name': '122 Phthalo Blue' },
        { 'pantoneCode': '406', 'hex': '26333C', 'mosaicoNumber': '051', 'name': '051 Midnight Blue' },
        { 'pantoneCode': '2383', 'hex': '1D3337', 'mosaicoNumber': '020', 'name': '020 Deep Blue' },
        { 'pantoneCode': '', 'hex': '2F4C5A', 'mosaicoNumber': '084', 'name': '084 Heron Blue' },
        { 'pantoneCode': '', 'hex': '1C4B5D', 'mosaicoNumber': '066', 'name': '066 Mariana Blue' },
        { 'pantoneCode': '7594', 'hex': '114C5C', 'mosaicoNumber': '017', 'name': '017 Blue' },
        { 'pantoneCode': '', 'hex': '42522E', 'mosaicoNumber': '033', 'name': '033 Dark Green' },
        { 'pantoneCode': '', 'hex': '234A47', 'mosaicoNumber': '113', 'name': '118 Deep Pine Green' },
        { 'pantoneCode': '', 'hex': '305D60', 'mosaicoNumber': '113', 'name': '117 Viridian Green' },
        { 'pantoneCode': '', 'hex': '2F6B61', 'mosaicoNumber': '090', 'name': '090 Sea Green' },
        { 'pantoneCode': '3547', 'hex': '355530', 'mosaicoNumber': '011', 'name': '011 Green' },
        { 'pantoneCode': '', 'hex': '3F5D39', 'mosaicoNumber': '103', 'name': '103 Jade' },
        { 'pantoneCode': '', 'hex': '10727B', 'mosaicoNumber': '111', 'name': '111 Blue Green' },
        { 'pantoneCode': '437', 'hex': '4F9E8D', 'mosaicoNumber': '021', 'name': '021 Aquamarine' },
        { 'pantoneCode': '', 'hex': '618F73', 'mosaicoNumber': '113', 'name': '115 Basil' },
        { 'pantoneCode': '', 'hex': '6A8D63', 'mosaicoNumber': '107', 'name': '107 Light Green' },
        { 'pantoneCode': '', 'hex': '699F91', 'mosaicoNumber': '113', 'name': '116 Laurel' },
        { 'pantoneCode': '', 'hex': '77AB97', 'mosaicoNumber': '113', 'name': '114 Sea Mist' },
        { 'pantoneCode': '', 'hex': 'BEC380', 'mosaicoNumber': '092', 'name': '092 Pale Green' },
        { 'pantoneCode': '', 'hex': 'CFD19D', 'mosaicoNumber': '104', 'name': '104 Pistachio' },
        { 'pantoneCode': '406', 'hex': 'BFCAB7', 'mosaicoNumber': '043', 'name': '043 White Green' },
        { 'pantoneCode': '', 'hex': 'B7B59E', 'mosaicoNumber': '073', 'name': '073 Asparagus' },
        { 'pantoneCode': '', 'hex': '7D7E6C', 'mosaicoNumber': '106', 'name': '106 Pine Green' },
        { 'pantoneCode': '406', 'hex': '757F66', 'mosaicoNumber': '060', 'name': '060 Moss Green' },
        { 'pantoneCode': '2205', 'hex': '6D7949', 'mosaicoNumber': '014', 'name': '014 Light Olive Green' },
        { 'pantoneCode': '', 'hex': '6A6838', 'mosaicoNumber': '102', 'name': '102 Olive Green' },
        { 'pantoneCode': '', 'hex': 'BCA554', 'mosaicoNumber': '094', 'name': '094 Army Green' },
        { 'pantoneCode': '406', 'hex': '856E3E', 'mosaicoNumber': '049', 'name': '049 Khaki Yellow' },
        { 'pantoneCode': '', 'hex': 'B3883D', 'mosaicoNumber': '081', 'name': '081 Mustard Yellow' },
        { 'pantoneCode': '', 'hex': 'BB8130', 'mosaicoNumber': '031', 'name': '031 Dark Yellow' },
        { 'pantoneCode': '7619', 'hex': 'BB8A4F', 'mosaicoNumber': '018', 'name': '018 Peach' },
        { 'pantoneCode': '2473', 'hex': 'DC9631', 'mosaicoNumber': '010', 'name': '010 Yellow' },
        { 'pantoneCode': '', 'hex': 'C9A24E', 'mosaicoNumber': '113', 'name': '113 Corn' },
        { 'pantoneCode': '406', 'hex': 'E4AA4F', 'mosaicoNumber': '042', 'name': '042 Light Yellow' },
        { 'pantoneCode': '406', 'hex': 'DEB269', 'mosaicoNumber': '056', 'name': '056 Peach Yellow' },
        { 'pantoneCode': '', 'hex': 'EAA379', 'mosaicoNumber': '113', 'name': '129 Melon' },
        { 'pantoneCode': '', 'hex': 'E39854', 'mosaicoNumber': '113', 'name': '128 Tangerine' },
        { 'pantoneCode': '438', 'hex': 'BC7441', 'mosaicoNumber': '015', 'name': '015 Yellow Orange' },
        { 'pantoneCode': '406', 'hex': 'BF693A', 'mosaicoNumber': '041', 'name': '041 Orange' },
        { 'pantoneCode': '', 'hex': 'A75D44', 'mosaicoNumber': '070', 'name': '070 Cool Orange' },
        { 'pantoneCode': '7499', 'hex': '8B4B32', 'mosaicoNumber': '037', 'name': '037 Burnt Chestnut' },
        { 'pantoneCode': '406', 'hex': '804C27', 'mosaicoNumber': '038', 'name': '038 Burnt Orange' },
        { 'pantoneCode': '406', 'hex': '855429', 'mosaicoNumber': '064', 'name': '064 Marmalade' },
        { 'pantoneCode': '', 'hex': 'D3934C', 'mosaicoNumber': '075', 'name': '075 Light Marmalade' },
        { 'pantoneCode': '', 'hex': 'BB7456', 'mosaicoNumber': '069', 'name': '069 Light Orange' },
        { 'pantoneCode': '406', 'hex': 'B3988D', 'mosaicoNumber': '061', 'name': '061 Rosewood Pink' },
        { 'pantoneCode': '', 'hex': 'F1A38F', 'mosaicoNumber': '096', 'name': '096 Blush' },
        { 'pantoneCode': '', 'hex': 'E3AEAA', 'mosaicoNumber': '113', 'name': '125 Cool Pink' },
        { 'pantoneCode': '', 'hex': 'C0807E', 'mosaicoNumber': '113', 'name': '126 Flamingo' },
        { 'pantoneCode': '', 'hex': 'AF787B', 'mosaicoNumber': '113', 'name': '127 Deep Rose' },
        { 'pantoneCode': '', 'hex': 'B3736A', 'mosaicoNumber': '095', 'name': '095 Pink' },
        { 'pantoneCode': '406', 'hex': 'AA6253', 'mosaicoNumber': '050', 'name': '050 Salmon' },
        { 'pantoneCode': '', 'hex': 'AF5C4C', 'mosaicoNumber': '093', 'name': '093 Coral Red' },
        { 'pantoneCode': '406', 'hex': '9C4F3D', 'mosaicoNumber': '052', 'name': '052 Chestnut' },
        { 'pantoneCode': '406', 'hex': '814138', 'mosaicoNumber': '047', 'name': '047 Antique Red' },
        { 'pantoneCode': '2945', 'hex': '801915', 'mosaicoNumber': '013', 'name': '013 Red' },
        { 'pantoneCode': '', 'hex': '893721', 'mosaicoNumber': '082', 'name': '082 Crimson Red' },
        { 'pantoneCode': '406', 'hex': '7B352E', 'mosaicoNumber': '046', 'name': '046 Rust Red' },
        { 'pantoneCode': '649', 'hex': '652C26', 'mosaicoNumber': '023', 'name': '023 Wine' },
        { 'pantoneCode': '', 'hex': '6A342A', 'mosaicoNumber': '029', 'name': '029 Umber' },
        { 'pantoneCode': '7528', 'hex': '743F31', 'mosaicoNumber': '022', 'name': '022 Terracotta Red' },
        { 'pantoneCode': '406', 'hex': '783D2B', 'mosaicoNumber': '045', 'name': '045 Fire Brick' },
        { 'pantoneCode': '7415', 'hex': '5b3b26', 'mosaicoNumber': '019', 'name': '019 Pecan' },
        { 'pantoneCode': '7720', 'hex': '3d201c', 'mosaicoNumber': '024', 'name': '024 Chocolate Brown' },
        { 'pantoneCode': '', 'hex': '523C2F', 'mosaicoNumber': '034', 'name': '034 Dark Brown' },
        { 'pantoneCode': '', 'hex': '604237', 'mosaicoNumber': '079', 'name': '079 Coffee' },
        { 'pantoneCode': '', 'hex': '5D4739', 'mosaicoNumber': '076', 'name': '076 Brown' },
        { 'pantoneCode': '406', 'hex': '5C4B45', 'mosaicoNumber': '062', 'name': '062 Dark Burlywood' },
        { 'pantoneCode': '406', 'hex': '745E53', 'mosaicoNumber': '044', 'name': '044 Burlywood' },
        { 'pantoneCode': '406', 'hex': 'A77B3C', 'mosaicoNumber': '048', 'name': '048 Golden Brown' },
        { 'pantoneCode': '406', 'hex': '775242', 'mosaicoNumber': '054', 'name': '054 Saddle Brown' },
        { 'pantoneCode': '406', 'hex': '7B5139', 'mosaicoNumber': '053', 'name': '053 Light Brown' },
        { 'pantoneCode': '7618', 'hex': '8A5C3B', 'mosaicoNumber': '016', 'name': '016 Sienna' },
        { 'pantoneCode': '', 'hex': 'B38D69', 'mosaicoNumber': '078', 'name': '078 Tan' },
        { 'pantoneCode': '406', 'hex': 'CAA179', 'mosaicoNumber': '055', 'name': '055 Beige' },
        { 'pantoneCode': '', 'hex': 'DCC09B', 'mosaicoNumber': '085', 'name': '085 Apricot' },
        { 'pantoneCode': '', 'hex': 'E8C38E', 'mosaicoNumber': '074', 'name': '074 Dark Beige' },
        { 'pantoneCode': '406', 'hex': 'E2C88C', 'mosaicoNumber': '063', 'name': '063 Warm Beige' },
        { 'pantoneCode': '2470', 'hex': 'F4DFAA', 'mosaicoNumber': '012', 'name': '012 Ivory' },
        { 'pantoneCode': '', 'hex': 'E0D19E', 'mosaicoNumber': '032', 'name': '032 Daffodil' },
        { 'pantoneCode': '', 'hex': 'FDEFB2', 'mosaicoNumber': '077', 'name': '077 Porcelain' },
        { 'pantoneCode': '2022', 'hex': 'F1E8CB', 'mosaicoNumber': '036', 'name': '036 Milk White' },
        { 'pantoneCode': '', 'hex': 'FCFCF1', 'mosaicoNumber': '001', 'name': '001 White' },
        { 'pantoneCode': '5235', 'hex': 'CEC9BF', 'mosaicoNumber': '025', 'name': '025 Cool White' },
        { 'pantoneCode': '', 'hex': 'BBB7B4', 'mosaicoNumber': '108', 'name': '108 Cloud Gray' },
        { 'pantoneCode': '2274', 'hex': '9D978B', 'mosaicoNumber': '008', 'name': '008 Fog Gray' },
        { 'pantoneCode': '406', 'hex': '959081', 'mosaicoNumber': '040', 'name': '040 Pearl Gray' },
        { 'pantoneCode': '2274', 'hex': '867C71', 'mosaicoNumber': '009', 'name': '009 Smoke Gray' },
        { 'pantoneCode': '5U C GREY', 'hex': '736C65', 'mosaicoNumber': '027', 'name': '027 Chrome' },
        { 'pantoneCode': '2411', 'hex': '71675E', 'mosaicoNumber': '004', 'name': '004 Light Gray' },
        { 'pantoneCode': '7461', 'hex': '665F57', 'mosaicoNumber': '005', 'name': '005 Medium Gray' },
        { 'pantoneCode': '', 'hex': '7C7B77', 'mosaicoNumber': '109', 'name': '109 Storm Gray' },    
        { 'pantoneCode': '7407', 'hex': '564F47', 'mosaicoNumber': '006', 'name': '006 Dark Gray' },
        { 'pantoneCode': '', 'hex': '4C4646', 'mosaicoNumber': '091', 'name': '091 Charcoal Gray' },
        { 'pantoneCode': '2404', 'hex': '544B46', 'mosaicoNumber': '003', 'name': '003 Porpoise' },
         { 'pantoneCode': '', 'hex': '24282D', 'mosaicoNumber': '112', 'name': '112 Blue Black' },
        { 'pantoneCode': '2006', 'hex': '211C16', 'mosaicoNumber': '002', 'name': '002 Black' },


    ];

    document.addEventListener('DOMContentLoaded', e => {
        //console.log('clicked');
    window.$.ajax({
            url: '/tilesdesigner/codename/',
            type: 'get',
            dataType: 'JSON',
            data: {},
            success: function(data) {
                tileCode(data);
                
            }
        });
    }, false);

function tileCode(data){
    var option = '';
    $.each(data, function(i, item) {
        option = option + '<option value="'+ data[i].tile_code +'">'+ data[i].tile_code +'</option>';
    });
    $('#list-tilecode').html(option);

}

function gettileCode(value){
    //console.log($('#td-blank-tiles div').length);
    const listItems = $('#td-blank-tiles div');
    //console.log(listItems);

    $('#td-blank-tiles div img').each(function() {
        if($(this).attr('title') == value){
            $(this).parent().closest('div').css('display','block');
        } else{
            $(this).parent().closest('div').css('display','none');
        }
        
    }); 

}
function searchtitleValue(){
    $('input#search_tile').val('');
    $('#td-blank-tiles div').each(function() {
        $(this).css('display','block');
    });
}


</script>

<script type="text/javascript" src='/js/room/TilesDesigner/fabric.js'></script>
@if (config('app.js_as_module'))
<script type="module" src="/js/src/TilesDesigner/TilesDesigner.js"></script>
@else
<script src="/js/room/TilesDesigner/tilesDesigner.min.js"></script>
@endif
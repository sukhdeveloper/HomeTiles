<script>
    window.JsConstants = window.JsConstants || {};

    window.JsConstants.room = {
        id: '{{ isset($roomId) ? $roomId : '' }}' || undefined,
        // savedId: '{{ isset($savedRoomId) ? $savedRoomId : '' }}' || undefined,
        url: '{{ isset($savedRoomUrl) ? $savedRoomUrl : '' }}' || undefined,
        productCategories: {!! isset($product_categories) ? $product_categories : '[]' !!},
    };

    window.JsConstants.config = window.JsConstants.config || {};

    var tileExtraOptionsString = '{!! config('app.tiles_extra_options') !!}';
    window.JsConstants.config.tileExtraOptions = tileExtraOptionsString.split(',');

    window.JsConstants.config.saveImageAsDoc = Boolean({!! env('SAVE_IMAGE_AS_DOCUMENT', false) !!});

    window.JsConstants.config.Product = {
        rotoPrintSetAsName: Boolean({!! env('PRODUCT_ROTO_PRINT_SET_AS_NAME', false) !!}),
    }

    window.JsConstants.config.ProductInfo = {
        style: '{!! env('PRODUCT_INFO_STYLE', '') !!}' || undefined,
        additionalSearchFields: '{!! env('TILES_ADDITIONAL_SEARCH_FIELDS', '') !!}',

        size: Boolean({!! env('PRODUCT_INFO_SIZE', true) !!}),
        finish: Boolean({!! env('PRODUCT_INFO_FINISH', true) !!}),
        price: Boolean({!! env('PRODUCT_INFO_PRICE', true) !!}),
        url: Boolean({!! env('PRODUCT_INFO_URL', true) !!}),
        shape: Boolean({!! env('PRODUCT_INFO_SHAPE', true) !!}),
        colors: Boolean({!! env('PRODUCT_INFO_COLORS', true) !!}),
        // thickness: Boolean({!! env('PRODUCT_INFO_THICKNESS', true) !!}),
        rotoPrintSet: Boolean({!! env('PRODUCT_INFO_ROTO_PRINT_SET', true) !!}),
        category: Boolean({!! config('app.use_product_category') && env('PRODUCT_INFO_CATEGORY', false) !!}),
    }

    window.JsConstants.config.TiledSurface = {
        groutSize: {!! env('TILES_GROUT_SIZE', 4) !!},
        skewSize: {!! env('TILES_SKEW_SIZE', 0) !!},
    }

    window.JsConstants.config.TilesDesigner = '{!! config('app.tiles_designer') !!}';

    window.JsConstants.config.pdfLib = '{!! config('app.js_pdf_lib') !!}';

    window.JsConstants.config.productFilterSize = Boolean({!! env('PRODUCT_FILTER_SIZE', false) !!});
    window.JsConstants.config.productFilterFinish = Boolean({!! env('PRODUCT_FILTER_FINISH', false) !!});
    window.JsConstants.config.tilesFiltersHideOthers = Boolean({!! env('TILES_FILTERS_HIDE_OTHERS', false) !!});

    window.JsConstants.config.surfaceSelectBrushButtons = Boolean({!! env('SURFACE_SELECT_BRUSH_BUTTONS', false) !!});

    window.JsConstants.config.watermarkedAlpha = '{!! env('WATERMARK_ALPHA', 0.15) !!}';

    window.JsConstants.config.useProductCategory = Boolean('{!! config('app.use_product_category') !!}');
</script>

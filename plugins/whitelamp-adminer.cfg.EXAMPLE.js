
var whitelampAdminer = {
    barcode : {
        columns : [
            ['whereware','ww_sku','sku'],
        ]
    },
    inputConstraint {
        classNameFail : 'input-invalid',
        regexp : [
            {
                pattern : ['whereware','ww_sku','sku','[A-z0-9\-]{3,64}'],
                keydown : ['whereware','ww_sku','sku','[A-z0-9\-]'],
            }
        ]
    }
}


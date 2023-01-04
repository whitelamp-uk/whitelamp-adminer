
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
                pattern : [
                    ['whereware','ww_sku','sku','[A-z0-9\-]{3,64}'],
                ],
                keydown : [
                    ['whereware','ww_sku','sku','[A-z0-9\-]'],
                ],
                readonly : [
                    ['whereware','ww_bin','id'],
                    ['whereware','ww_booking','id'],
                    ['whereware','ww_composite','id'],
                    ['whereware','ww_consignment','id'],
                    ['whereware','ww_generic','id'],
                    ['whereware','ww_location','id'],
                    ['whereware','ww_move','id'],
                    ['whereware','ww_organisation','id'],
                    ['whereware','ww_project','id'],
                    ['whereware','ww_refresh','id'],
                    ['whereware','ww_sku','id'],
                    ['whereware','ww_status','id'],
                    ['whereware','ww_team','id'],
                    ['whereware','ww_user','id'],
                    ['whereware','ww_variant','id'],
                    ['whereware','ww_web','id'],
                ],
            }
        ]
    },
}


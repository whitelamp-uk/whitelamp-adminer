
(
    function () {
        function barcodeInputKeydown (evt) {
            if (evt.key=='*' || evt.key=='Enter') {
                evt.preventDefault ();
            }
        }
        var input,inputs;
        inputs = document.querySelectorAll ('input.barcode-in');
        for (input of inputs) {
            input.addEventListener ('keydown',barcodeInputKeydown);
        }
    }
) ();


<script <?php echo nonce(); ?> >
document.addEventListener (
    'DOMContentLoaded',
    function ( ) {
        function click (evt) {
            if (evt.buttons!=1) {
                return;
            }
            if (evt.ctrlKey || evt.shiftKey) {
                // Adminer uses Ctrl-click for cell editing
                // Shift-click could be used for something else
                return;
            }
            if (!evt.currentTarget.closest('table').classList.contains('whitelamp-adminer-autocopy')) {
                return;
            }
            // Prevent Adminer row select
            evt.stopPropagation ();
        }
        function down (evt) {
            if (evt.buttons!=1) {
                return;
            }
            if (!evt.currentTarget.closest('table').classList.contains('whitelamp-adminer-autocopy')) {
                return;
            }
            evt.currentTarget.dataset.autocopy = '1';
            evt.currentTarget.style.transition = '';
            evt.currentTarget.style.backgroundColor = 'rgb(255,223,223)';
        }
        function over (evt) {
            if (evt.buttons!=1) {
                return;
            }
            if (!evt.currentTarget.closest('table').classList.contains('whitelamp-adminer-autocopy')) {
                return;
            }
            var c0,c1,cols,i,j,r0,r1,rows,start,tbody,td,tds,tr,trs;
            start = document.querySelector ('td[data-autocopy]');
            i = 1 * start.dataset.autocopycolumn;
            j = 1 * evt.currentTarget.dataset.autocopycolumn;
            if (j>i) {
                c0 = i;
                c1 = j;
            }
            else {
                c0 = j;
                c1 = i;
            }
            j = 1 * start.closest('tr').dataset.autocopyrow;
            i = 1 * evt.currentTarget.closest('tr').dataset.autocopyrow;
            if (j>i) {
                r0 = i;
                r1 = j;
            }
            else {
                r0 = j;
                r1 = i;
            }
            trs = start.closest('tbody').querySelectorAll ('tr[data-autocopyrow]');
            j = 0;
            for (tr of trs) {
                j++;
                i = 0;
                tds = tr.querySelectorAll ('td[data-autocopycolumn]');
                for (td of tds) {
                    i++;
                    td.style.transition = '';
                    if (j>=r0 && j<=r1 && i>=c0 && i<=c1) {
                        td.style.backgroundColor = 'rgb(255,223,223)';
                    }
                    else {
                        td.style.backgroundColor = '';
                    }
                }
            }
        }
        function select (evt) {
            if (!evt.currentTarget.closest('table').classList.contains('whitelamp-adminer-autocopy')) {
                return;
            }
            evt.preventDefault ();
        }
        function toggle (evt) {
            var table;
            table = document.querySelector ('#table');
            if (table) {
                if (evt.currentTarget.classList.contains('active')) {
                    table.classList.remove ('whitelamp-adminer-autocopy');
                    evt.currentTarget.classList.remove ('active');
                    evt.currentTarget.setAttribute ('title','Click to copy cells to clipboard');
                }
                else {
                    table.classList.add ('whitelamp-adminer-autocopy');
                    evt.currentTarget.classList.add ('active');
                    evt.currentTarget.setAttribute ('title','Click to switch off AutoCopy');
                }
            }
        }
        function up (evt) {
            if (!evt.currentTarget.closest('table').classList.contains('whitelamp-adminer-autocopy')) {
                return;
            }
            var c0,c1,d,data,i,j,n,r0,r1,start,tbody,td,tdcur,tds,tr,trs,txt;
            start = document.querySelector ('td[data-autocopy]');
            delete start.dataset.autocopy;
            i = 1 * start.dataset.autocopycolumn;
            j = 1 * evt.currentTarget.dataset.autocopycolumn;
            if (j>i) {
                c0 = i;
                c1 = j;
            }
            else {
                c0 = j;
                c1 = i;
            }
            j = 1 * start.closest('tr').dataset.autocopyrow;
            i = 1 * evt.currentTarget.closest('tr').dataset.autocopyrow;
            if (j>i) {
                r0 = i;
                r1 = j;
            }
            else {
                r0 = j;
                r1 = i;
            }
            data = [];
            trs = start.closest('tbody').querySelectorAll ('tr[data-autocopyrow]');
            j = 0;
            for (tr of trs) {
                j++;
                d = [];
                i = 0;
                tds = tr.querySelectorAll ('td[data-autocopycolumn]');
                for (td of tds) {
                    i++;
                    if (j>=r0 && j<=r1 && i>=c0 && i<=c1) {
                        n = td.querySelector ('i');
                        if (n) {
                            n = (n.innerText=='NULL');
                        }
                        if (n) {
                            d.push (null);
                        }
                        else {
                            d.push (td.innerText);
                        }
                        td.style.backgroundColor = 'rgb(255,127,127)';
                    }
                }
                if (j>=r0 && j<=r1) {
                    data.push (d);
                }
            }
            setTimeout (
                function ( ) {
                    var cell,cells;
                    cells = document.body.querySelectorAll ('#table td[data-autocopycolumn]');
                    for (cell of cells) {
                        cell.style.transition = 'background-color 1.0s';
                        cell.style.backgroundColor = '';
                    }
                    setTimeout (
                        function ( ) {
                            var c, cs;
                            cs = document.body.querySelectorAll ('#table td[data-autocopycolumn]');
                            for (c of cs) {
                                    c.style.transition = '';
                            }
                        },
                        1400
                    );
                },
                200
            );
            navigator.clipboard.writeText (JSON.stringify(data,null,4));
        }
        function upBody (evt) {
            var table,td,tds;
            table = document.querySelector ('#table');
            if (!table.contains(evt.target)) {
                td = document.querySelector ('td[data-autocopy]');
                if (td) {
                    delete td.dataset.autocopy;
                }
                tds = table.querySelectorAll ('tbody td[id]');
                for (td of tds) {
                    td.style.transition = '';
                    td.style.backgroundColor = '';
                }
            }
        }
        var td,tds,tr,trs,x,y;
        trs = document.querySelectorAll ('#table tbody tr');
        if (trs.length) {
            img = document.createElement ('img');
            img.classList.add ('whitelamp-adminer-autocopy');
            img.setAttribute ('title','Click to copy cells to clipboard');
            img.addEventListener ('click',toggle);
            document.body.appendChild (img);
            document.body.addEventListener ('mouseup',upBody);
        }
        y = 0;
        for (tr of trs) {
            y++;
            tr.dataset.autocopyrow = y;
            tds = tr.querySelectorAll ('td[id]');
            x = 0;
            for (td of tds) {
                x++;
                td.dataset.autocopycolumn = x;
                td.addEventListener ('click',click);
                td.addEventListener ('mousedown',down);
                td.addEventListener ('mouseover',over);
                td.addEventListener ('mouseup',up);
                td.addEventListener ('selectstart',select);
            }
        }
    }
);
</script>
<style>
img.whitelamp-adminer-autocopy {
    position: absolute;
    left: 1340px;
    top: 58px;
    border-style: solid;
    border-width: 1px;
    content: url('./autocopy-icon.png');
    cursor: pointer;
}
img.whitelamp-adminer-autocopy.active {
    content: url('./autocopy-icon-active.png');  
}
@media (max-width: 1405px) {
    img.whitelamp-adminer-autocopy {
        left: calc(100vw - 65px);
    }
}
#table.whitelamp-adminer-autocopy td a:nth-child(1) {
    margin-left: 1em;
}
</style>


var teste = '';

function setResultado(arrValores)
{
    var table = new Tabulator(
        "#div_resultado",
        {
            data : arrValores,
            autoColumns : true,
            selectableRangeMode:"click",
            selectable:true,
        }
    );
}
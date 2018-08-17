// if page is taller than the viewport height, redo the footer
window.onload = function () {
    setFooterPosition();
}

document.body.onresize = function () {
    setFooterPosition();
}

function setFooterPosition() {
    var body = document.body,
        html = document.documentElement;

    var pageHeight = Math.max( body.scrollHeight, body.offsetHeight,
        html.clientHeight, html.scrollHeight, html.offsetHeight );

    var vwHeight = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);

    if (pageHeight <= vwHeight) {
        document.getElementsByTagName("footer")[0].style.bottom = "0";
    }
}

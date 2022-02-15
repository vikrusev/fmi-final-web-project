function showHide(element) {
    const closestParentClassList = element.closest('.group, .sub-group').classList;

    if (closestParentClassList.contains('hidden')) {
        closestParentClassList.remove('hidden');
    }
    else {
        closestParentClassList.add('hidden');
    }
}

function copyToClipboard(json) {
    navigator.clipboard.writeText(JSON.stringify(json, null, 2));
    alert('Запазено в клипборда!');
}

function logout() {
    document.getElementById('logout').submit();
}

function prepareHistory(histories) {
    alert(histories)
}
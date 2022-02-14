function showHide(element) {
    const closestParentClassList = element.closest('.group, .sub-group').classList;

    if (closestParentClassList.contains('hidden')) {
        closestParentClassList.remove('hidden');
    }
    else {
        closestParentClassList.add('hidden');
    }
}

function logout() {
    document.getElementById('logout').submit();
}
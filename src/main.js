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

function goBack(target) {
    window.location.replace(target);
}

function deleteHistoryItem(historyId, historyName) {
    const prompt = confirm(`Сигурни ли сте, че искате да изтриете история с име "${historyName ? historyName : '<празно>'}" и id "${historyId}"?`);

    if (prompt) {
        window.location.replace(`../server/delete_history.php?history_id=${historyId}`);
    }
}

function logout() {
    document.getElementById('logout').submit();
}

function prepareHistory(histories) {
    alert(histories)
}
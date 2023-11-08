function displayDifferencesSummary(compareJsonActionResults) {
    //input from php: coming from index.php
    let differences = compareJsonActionResults

    let diffColumnNumber = 0;
    let diffOnlyInFile1 = 0;
    let diffOnlyInFile2 = 0;
    let valueExistInBothFilesWithDifferences = 0;
    for (let jsonPathToDiff in differences) {
        diffColumnNumber++
        console.log(differences[jsonPathToDiff])
        switch (differences[jsonPathToDiff].op) {
            case "test":
                diffOnlyInFile1++;
                valueExistInBothFilesWithDifferences++;
                break;
            case "replace":
                diffOnlyInFile2++;
                valueExistInBothFilesWithDifferences++;
                break;
            case "remove":
                diffOnlyInFile1++;
                valueExistInBothFilesWithDifferences++;
                break;
            case "add":
                diffOnlyInFile2++;
                valueExistInBothFilesWithDifferences++;
                break;
        }
    }

    let tableSummaryHtml = '<div class="row align-items-center">'

    tableSummaryHtml += buildSummaryCard('Total Differences', diffColumnNumber)
    tableSummaryHtml += buildSummaryCard('Differences found in ' + jsonFileName1, diffOnlyInFile1)
    tableSummaryHtml += buildSummaryCard('Differences found in ' + jsonFileName2, diffOnlyInFile2)
    tableSummaryHtml += buildSummaryCard('Differences found in Both files', valueExistInBothFilesWithDifferences)

    tableSummaryHtml += '</div>'

    return tableSummaryHtml;
}

function buildSummaryCard(cartTitle, cartBody) {
    let tableSummaryColumnHtml = '<div class="col border-success">' +
        '<div class="card">' +
        '<div class="card-header text-white bg-secondary font-weight-bold"><h5>'
    tableSummaryColumnHtml += cartTitle
    tableSummaryColumnHtml += '</h5></div>'
    tableSummaryColumnHtml += '<div class="card-body">'
    tableSummaryColumnHtml += '<h3 class="card-text font-weight-bold align-items-center d-flex justify-content-center">' + cartBody + '</h3>'
    tableSummaryColumnHtml += '</div>' +
        '</div>' +
        '</div>'

    return tableSummaryColumnHtml;
}

let differencesSummaryElement = document.getElementById('differencesSummary');
if (differencesSummaryElement != null && typeof differencesSummaryElement != 'undefined' && differencesSummaryElement.length !== 0) {
    differencesSummaryElement.innerHTML = displayDifferencesSummary(compareJsonActionResults)
}


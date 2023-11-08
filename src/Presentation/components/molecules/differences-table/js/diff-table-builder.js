function generateDiffTableRows(differences) {
    let tableRows = '';
    let diffColumnNumber = 0;
    let pathInJson1 = '';
    let pathInJson2 = '';
    for (let jsonPathToDiff in differences) {
        diffColumnNumber++;

        tableRows += `
            <tr>
                <td>${diffColumnNumber}</td>
                ${generateRowPathInJson(jsonPathToDiff, differences)}
                ${buildDiffFile1File2PreElement(jsonPathToDiff, differences, diffColumnNumber)}
            </tr>
        `;
    }

    return tableRows;
}


function generateRemovedTableRows(differences) {
    let tableRows = '';
    let diffColumnNumber = 0;
    let pathInJson1 = '';
    let pathInJson2 = '';
    for (let jsonPathToDiff in differences) {
        diffColumnNumber++;

        tableRows += `
            <tr>
                <td>${diffColumnNumber}</td>
                ${generateRemovedRowPathInJson(jsonPathToDiff, differences)}
            </tr>
        `;
    }

    return tableRows;
}


function generateRowPathInJson(jsonPathToDiff, differences){
   return `<td>${differences[jsonPathToDiff].path}</td>`
}

function generateRemovedRowPathInJson(jsonPathToDiff, differences){
    return `<td colSpan="2">${differences[jsonPathToDiff]}</td>`
}

function generateRowPathInJson1(jsonPathToDiff, differences) {
    console.log(differences[jsonPathToDiff])
    let rowPathInJsonHtml1 = '';
    if (differences[jsonPathToDiff].op === 'remove' || differences[jsonPathToDiff].op === 'test') {
        rowPathInJsonHtml1 = `<td>${differences[jsonPathToDiff].path}</td>`
        return rowPathInJsonHtml1;
    }

    rowPathInJsonHtml1 = `<td>${falseIcon}</td>`
    return rowPathInJsonHtml1;
}

function generateRowPathInJson2(jsonPathToDiff, differences) {
    let rowPathInJsonHtml2 = '';
    if (differences[jsonPathToDiff].op === 'replace' || differences[jsonPathToDiff].op === 'add') {
        rowPathInJsonHtml2 = `<td>${differences[jsonPathToDiff].path}</td>`
        return rowPathInJsonHtml2;
    }

    rowPathInJsonHtml2 = `<td>${falseIcon}</td>`
    return rowPathInJsonHtml2;
}

const VALUE_DOES_NOT_EXIST = 'VALUE_DOES_NOT_EXIST';

function buildDiffFile1File2PreElement(jsonPathToDiff, difference, diffColumnNumber) {
    const diffInFile1 = getDiffInFile1(difference, jsonPathToDiff);
    const diffInFile2 = getDiffInFile2(difference, jsonPathToDiff);

    const diff1Output = stringifyDiff(diffInFile1);
    const diff2Output = stringifyDiff(diffInFile2);

    const formattedDiff1Output = formatOutput(diff1Output, falseIcon);
    const formattedDiff2Output = formatOutput(diff2Output, falseIcon);

    return generateHtmlForDiff(formattedDiff1Output, diffColumnNumber) +
        generateHtmlForDiff(formattedDiff2Output, diffColumnNumber);
}

function getDiffInFile1(difference, jsonPathToDiff) {

    return difference[jsonPathToDiff].original;
}

function getDiffInFile2(difference, jsonPathToDiff) {
    return difference[jsonPathToDiff].new;
}

function stringifyDiff(diff) {
    return JSON.stringify(diff, null, 2);
}

function formatOutput(diff, icon) {
    if (diff === VALUE_DOES_NOT_EXIST) {
        return icon + VALUE_DOES_NOT_EXIST;
    }
    return diff;
}

function generateHtmlForDiff(diff, diffColumnNumber) {
    if (diff.charAt(0) === '{') {
        return generateAccordionForJsonPreElement(diff, 'heading-' + diffColumnNumber);
    } else {
        return '<td><pre> ' + diff + '</pre></td>';
    }
}

function generateAccordionForJsonPreElement(diffOutput, elementId) {

    let accordionForJsonPreElementHtml =
        `<td>
            <div style="display: flex;justify-content: space-between; margin: 0;">
                <pre id="json-container-${elementId}" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    ${diffOutput}
                </pre>
                <span onClick="toggleShowMore('${elementId}')" id="show-more-${elementId}">${arrowDownIcon}</span>
            </div>
        </td>`

    return accordionForJsonPreElementHtml
}

const differencesTableRows = generateDiffTableRows(compareJsonActionResults);
const differencesTableRowsElement = document.getElementById('differencesTableRows');

if (differencesTableRowsElement != null && typeof compareJsonActionResults != 'undefined' && compareJsonActionResults.length !== 0) {
    differencesTableRowsElement.innerHTML = differencesTableRows;
}

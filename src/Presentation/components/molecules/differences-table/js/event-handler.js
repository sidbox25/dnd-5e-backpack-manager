function toggleShowMore(elementId) {
    let jsonContainer = document.getElementById(`json-container-${elementId}`);
    let showMoreButton = document.getElementById(`show-more-${elementId}`);

    if (jsonContainer) {
        if (jsonContainer.style.whiteSpace === 'nowrap') {
            //show less
            jsonContainer.style.whiteSpace = 'pre-line';
            jsonContainer.style.overflowY = 'auto';
            jsonContainer.style.textOverflow = 'initial';
            jsonContainer.style.overflowX = 'scroll';
            showMoreButton.innerHTML = arrowUpIcon;
        } else {
            //show more
            jsonContainer.style.whiteSpace = 'nowrap';
            jsonContainer.style.overflow = 'hidden';
            jsonContainer.style.textOverflow = 'ellipsis';
            showMoreButton.innerHTML = arrowDownIcon;
        }
    } else {
        console.error(`Element with ID 'json-container-${elementId}' not found.`);
    }
}


function goToRemovedTable() {

    let tableRemovedHtml = `<table class="table table-bordered table-hover">

            <thead class="upper-header">
            <tr>
                <th scope="col" colSpan="3">Paths and Values only exists in ${jsonFileName1}</th>
                <th scope="col">
                   <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a onclick="goToDiffTable()">Diff Table</a></li>
                        <li class="breadcrumb-item"><a href="#">Removed Table</a></li>
                        <li class="breadcrumb-item"><a onclick="goToAddedTable()">Added Table</a></li>
                    </ol>
                </nav>
                </th>
            </tr>
            </thead>

            <thead class="table-dark align-middle rounded" id="lower-header">
            <tr>
                <th scope="col" class="diff-column-number">Diff. Nr</th>
                <th scope="col" colSpan="2">Path</th>
                <th scope="col">Value: <span class="json-file-name1"> ${jsonFileName1} </span></th>
            </tr>
            </thead>
            <tbody id="differencesTableRows">
            ${generateRemovedTableRows(compareJsonActionResultsRemoved)}
            </tbody>
        </table>
    </div>`;


const differencesTableElement = document.getElementById('differencesTable');
    differencesTableElement.innerHTML = tableRemovedHtml;

}


function goToDiffTable() {

let tableRemovedHtml = `  <table class="table table-bordered table-hover">

        <thead class="upper-header">
        <tr>
            <th scope="col" colspan="3">Different values of path present in both files</th>
            <th scope="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Diff Table</a></li>
                        <li class="breadcrumb-item"><a onclick="goToRemovedTable()">Removed Table</a></li>
                        <li class="breadcrumb-item"><a onclick="goToAddedTable()">Added Table</a></li>
                    </ol>
                </nav>
             </th>
        </tr>
        </thead>

        <thead class="table-dark align-middle rounded" id="lower-header">
        <tr>
            <th scope="col" class="diff-column-number">Diff. Nr</th>
            <th scope="col">Path</th>
            <th scope="col">Value: <span class="json-file-name1"> {{ jsonFileName1 }} </span></th>
            <th scope="col">Value: <span class="json-file-name2"> {{ jsonFileName2 }} </span></th>
        </tr>
        </thead>
        <tbody id="differencesTableRows">
        ${generateDiffTableRows(compareJsonActionResults)}
        </tbody>
    </table>`;


const differencesTableElement = document.getElementById('differencesTable');
differencesTableElement.innerHTML = tableRemovedHtml;

}

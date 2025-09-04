<script>

        let nepaliDatasetContainer;
        let englishDatasetContainer;

        let nepaliDatasetHeader;
        let englishDatasetHeader;

        let nepaliDataset;
        let englishDataset;


        document.addEventListener("DOMContentLoaded", function() {
            nepaliDataset = document.getElementById('nepaliDataset');
            englishDataset = document.getElementById('englishDataset');

            nepaliDatasetHeader = document.getElementById('nepaliDatasetHeader');
            englishDatasetHeader = document.getElementById('englishDatasetHeader');

            nepaliDatasetContainer = document.getElementById('nepaliDatasetContainer');
            englishDatasetContainer = document.getElementById('englishDatasetContainer');
        });



        function addRow() {



            row++;
            console.log(englishDatasetContainer);
            let newRow = document.createElement('tr');
            newRow.id = `row${row}`;
            for (let j = 1; j <= col; j++) {
                let newCell = document.createElement('td');
                let input = document.createElement('input');
                input.type = 'text';
                input.className = 'input-dataset';
                input.name = `englishCol${j}[]`;
                newCell.appendChild(input);
                newRow.appendChild(newCell);
            }
            englishDatasetContainer.appendChild(newRow);
            addNepaliRow();
        }

        function addNepaliRow(){
            let newRow = document.createElement('tr');
            newRow.id = `row${row}`;
            for (let j = 1; j <= col; j++) {
                let newCell = document.createElement('td');
                let input = document.createElement('input');
                input.type = 'text';
                input.className = 'input-dataset';
                input.name = `nepaliCol${j}[]`;
                newCell.appendChild(input);
                newRow.appendChild(newCell);
            }
            nepaliDatasetContainer.appendChild(newRow);
        }

        document.getElementById('datasetForm').addEventListener('submit', function(event) {

            event.preventDefault();
            let nepaliDatasetDiv = document.getElementById('nepaliDataset');
            let innerHTMLContent = nepaliDatasetDiv.innerHTML;

            document.getElementById('columns').value = col;
            this.submit();
        });

        function createInputTable() {
            row = document.getElementById('nRows').value;
            col = document.getElementById('nColumns').value;


            nepaliDatasetContainer.innerHTML = '';

            for (let i = 1; i <= col; i++) {
                let headerCell = document.createElement('th');
                let input = document.createElement('input');
                input.type = 'text';
                input.className = 'input-dataset';
                input.name = `nepaliCol${i}[]`;
                headerCell.appendChild(input);
                nepaliDatasetHeader.appendChild(headerCell);

            }

            for (let i = 2; i <= row; i++) {
                let newRow = document.createElement('tr');
                newRow.id = `row${i}`;
                for (let j = 1; j <= col; j++) {
                    let newCell = document.createElement('td');
                    let input = document.createElement('input');
                    input.type = 'text';
                    input.className = 'input-dataset';
                    input.name = `nepaliCol${j}[]`;
                    newCell.appendChild(input);
                    newRow.appendChild(newCell);
                }
                nepaliDatasetContainer.appendChild(newRow);
            }

            createEnglishTable(row, col);

            document.getElementById('addButton').innerHTML =
                `<button type="button" class="btn btn-primary" onclick="addRow()">Add Row</button>`;
            document.getElementById('createTableVar').innerHTML = "";
        }

        function createEnglishTable(row, col) {

            englishDatasetContainer.innerHTML = '';

            for (let i = 1; i <= col; i++) {
                let headerCell = document.createElement('th');
                let input = document.createElement('input');
                input.type = 'text';
                input.className = 'input-dataset';
                input.name = `englishCol${i}[]`;
                headerCell.appendChild(input);
                englishDatasetHeader.appendChild(headerCell);

            }


            for (let i = 2; i <= row; i++) {
                let newRow = document.createElement('tr');
                newRow.id = `row${i}`;
                for (let j = 1; j <= col; j++) {
                    let newCell = document.createElement('td');
                    let input = document.createElement('input');
                    input.type = 'text';
                    input.className = 'input-dataset';
                    input.name = `englishCol${j}[]`;
                    newCell.appendChild(input);
                    newRow.appendChild(newCell);
                }
                englishDatasetContainer.appendChild(newRow);
            }
        }
    </script>

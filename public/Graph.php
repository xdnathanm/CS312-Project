<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <link rel="icon" type="image/x-icon" href="PixelForge.jpeg">
    <title>Graph page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background-color: #F5F5F5;
            color: #000000;
        }
        header {
            background: #065508;
            color: #F5F5F5;
            padding: 0.5rem 0;
            text-align: center;
            font-size: large;
            position: relative;
        }
        nav {
            background: #065508;
            padding: 0.5rem;
            text-align: center;
        }
        nav a {
            display: inline-block;
            background: #F5F5F5;
            color: #065508;
            text-decoration: none;
            padding: 0.5rem 1rem;
            margin: 0 0.5rem;
            border-radius: 25px;
            font-weight: bold;
            transition: background 0.3s ease, color 0.3s ease;
        }
        nav a:hover {
            background: #065508;
            color: #F5F5F5;
        }
        .container {
            max-width: 800px;
            margin: 2rem auto;
            background: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .input {
            text-align: center;
            padding-top: 50px;
            color: #000000;
        }
        table {
            border-collapse: collapse;
            margin: 24px auto;
        }
        td {
            width: 300px;
            height: 30px;
            border: 1px solid #000000;
        }
        #tableDiv {
            width: 800px;
        }
        .table1 {
            width: 200px;
            border-collapse: collapse;
            margin: 20px auto;
            overflow-y: scroll;
            overflow-x: scroll;
        }
        .table1 td {
            border: 1px solid #000000;
            padding: 0.75rem;
            width: 100%;
            vertical-align: middle;
        }
        .table1 td:first-child {
            width: 50%;
        }
        .table1 td:last-child {
            width: 80%;
        }
        .table1 select {
            width: 100px;
            margin-left: 10px;
        }
        #tableDiv2 {
            max-width: 800px;
            min-width: 800px;
            min-height: 500px;
            max-height: 500px;
            overflow-y: scroll;
            overflow-x: scroll;
        }
        .table2 {
            max-width: 800px;
            min-width: 800px;
        }
        .table2 td {
            max-width: 23px;
            min-width: 23px;
        }
        #printLogo {
            display: none;
            width: 100px;
            height: auto;
            position: absolute;
            top: 20px;
            left: 20px;
        }
        footer {
            text-align: center;
            margin-top: 2rem;
            padding-bottom: 2rem;
        }
        .print-hex {
            display: none;
        }
        @media print {
            body {
                filter: grayscale(100%);
            }
            #printLogo {
                display: block;
            }
            select,
            input[type="radio"],
            #printButton,
            nav,
            .input {
                display: none !important;
            }
            .print-hex {
                display: inline !important;
                font-style: italic;
                font-size: 0.9em;
                margin-left: 8px;
            }
            .table2 td {
                background-color: white !important;
            }
            td {
                color: black !important;
                border-color: black !important;
            }
            #printTitle {
                display: block !important;
                text-align: center;
                font-size: 1.5em;
                margin-top: 2rem;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Graphing</h1>
    <img src="PixelForge.jpeg" alt="Logo" id="printLogo" />
</header>

<nav>
    <a href="/index.html">Home</a>
    <a href="About.php">About Us</a>
    <a href="Database.php">Color Selection</a>
</nav>

<div class="container">
    <div class="input">
        <p>Enter the number of rows (between 1 and 1000), columns (between 1 and 702) you would like in your table,
            and the number of colors you would like to use(1-10)</p>
        <form id="tableForm">
            Rows: <input type="number" id="rows" name="rows" placeholder="1-1000" min="1" max="1000" required>
            Columns: <input type="number" id="columns" name="columns" placeholder="1-702" min="1" max="702" required>
            Colors: <input type="number" id="colors" name="colors" placeholder="1-10" min="1" max="10" required>
            <input type="submit">
        </form>
    </div>

    <div id="tableDiv"></div>
    <div id="tableDiv2"></div>
</div>

<script>
    document.getElementById("tableForm").addEventListener("submit", table);
    const colorChoices = ["Red", "Orange", "Yellow", "Green", "Blue", "Purple", "Grey", "Brown", "Black", "Teal"];
    const colorHexMap = {
        red: "#FF0000", orange: "#FFA500", yellow: "#FFFF00", green: "#008000", blue: "#0000FF",
        purple: "#800080", grey: "#808080", brown: "#A52A2A", black: "#000000", teal: "#008080"
    };
    let selectedColor = null; // default color that will not contain value until user selects a color

    function table(event) 
    {
        //prevents reload
        event.preventDefault();

        const rows = parseInt(document.getElementById("rows").value);
        const columns = parseInt(document.getElementById("columns").value);
        const colorNum = parseInt(document.getElementById("colors").value);
        const tableDiv = document.getElementById("tableDiv");
        const tableDiv2 = document.getElementById("tableDiv2");
        const table1 = document.createElement("table");

        //removes old table
        tableDiv.innerHTML = "";
        tableDiv2.innerHTML = "";

        //table1 style
        table1.className = "table1";

        const colorCoords = {};
        const coordDisplays = {};
        const coordToCell = {};
        const cellToCoord = new Map();
        const cellColorMap = new Map();

        for (let i = 0; i < colorNum; i++) 
        {
            const row = document.createElement("tr");
            const left = document.createElement("td");
            const radio = document.createElement("input");
            const select = document.createElement("select");
            const hexSpan = document.createElement("span");
            const right = document.createElement("td");

            radio.type = "radio";
            radio.name = "selected";
            select.name = "colorSelect";
            hexSpan.className = "print-hex";

            for(let j = 0; j < colorChoices.length; j++) 
            {
                const option = document.createElement("option");
                option.textContent = colorChoices[j];
                option.value = colorChoices[j].toLowerCase();
                select.append(option);
            }

            select.selectedIndex = i;
            hexSpan.textContent = ` (${colorHexMap[select.value]})`;
            const initialColor = select.value;
            colorCoords[initialColor] = [];
            coordDisplays[initialColor] = right;

            radio.addEventListener("change", () => {
                selectedColor = select.value;
            });

            select.addEventListener("change", () => {
                const oldColor = Object.keys(coordDisplays).find(k => coordDisplays[k] === right);
                const newColor = select.value;
                hexSpan.textContent = ` (${colorHexMap[newColor]})`;

                if (!colorCoords[newColor]) colorCoords[newColor] = [];

                colorCoords[oldColor].forEach(coord => {
                    const cell = coordToCell[coord];
                    if(cell) 
                    {
                        cell.style.backgroundColor = newColor;
                        cell.dataset.color = newColor;
                        cellColorMap.set(cell, newColor);
                    }
                    if(!colorCoords[newColor].includes(coord)) 
                    {
                        colorCoords[newColor].push(coord);
                    }
                });

                colorCoords[oldColor] = [];

                delete coordDisplays[oldColor];
                coordDisplays[newColor] = right;

                update(newColor);
                update(oldColor);

                if(radio.checked) 
                {
                    selectedColor = newColor;
                }
            });

            left.append(radio);
            left.append(select);
            left.append(hexSpan);
            row.append(left);
            row.append(right);
            table1.append(row);
        }

        tableDiv.append(table1);

        //const tableDiv2 = document.getElementByID("tableDiv2");
        const table2 = document.createElement("table");
        table2.className = "table2";
        //tableDiv2.innerHTML = "";
        // table2.style.overflow-y = "auto";
        al = 65; // aschii alphabet character start number(IE A)
        al2 = 65; // for the second alphabet charachter
        eal = 0;   // end of alphabet for the first A
        eal2 = 0; // end of alphabet for the second leter

        for(let i = 0; i <= rows; i++){
            const row = document.createElement("tr");

            for(let j = 0; j <= columns; j++){
                const column = document.createElement("td");

                // this addes the numbers in the rows
                if(j == 0 && i != 0){
                    const cell_text = document.createTextNode(`${i}`);
                    column.appendChild(cell_text);
                }

                // this adds the letters in the columns
                if(i == 0 && j != 0){
                    if(eal == 0){
                        const cell_text = document.createTextNode(`${String.fromCharCode(al)}`);
                        column.appendChild(cell_text);
                        al++;
                    }
                    else if(eal == 1){
                        if(eal2 == 1){
                            al++;
                            eal2 = 0;
                        }
                        const cell_text = document.createTextNode(`${String.fromCharCode(al)}${String.fromCharCode(al2)}`);
                        column.appendChild(cell_text);
                        al2++;
                    }

                    // sets the first alphabet aschii num back to 56 and sets the flag that for end of alph to be true.
                    if(al > 90){
                        eal = 1;
                        al = 65;
                    }

                    // sets the second alphabet aschii num back to 65
                    if(al2 > 90){
                        al2 = 65;
                        eal2 = 1;
                    }
                }

                // Adds clicking functionality, ensures that the user needs to select a
                // color before clicking on the table
                if(i !== 0 && j !== 0) 
                {
                    const coord = `${String.fromCharCode(64 + j)}${i}`;
                    coordToCell[coord] = column;
                    cellToCoord.set(column, coord);

                    column.addEventListener("click", () => {
                        if(!selectedColor) 
                        {
                            alert("Please select a color from Table 1.");
                            return;
                        }

                        const current = cellColorMap.get(column);
                        if(current) 
                        {
                            colorCoords[current] = colorCoords[current].filter(c => c !== coord);
                            update(current);
                        }

                        column.style.backgroundColor = selectedColor;
                        column.dataset.color = selectedColor;
                        cellColorMap.set(column, selectedColor);

                        if(!colorCoords[selectedColor].includes(coord)) 
                        {
                            colorCoords[selectedColor].push(coord);
                            colorCoords[selectedColor].sort((a, b) => {
                                const [aCol, aRow] = [a.match(/[A-Z]+/)[0], parseInt(a.match(/\d+/)[0])];
                                const [bCol, bRow] = [b.match(/[A-Z]+/)[0], parseInt(b.match(/\d+/)[0])];

                                if(aCol === bCol) 
                                {
                                    return aRow - bRow;
                                } 
                                else 
                                {
                                    return aCol.localeCompare(bCol);
                                }
                            });
                            update(selectedColor);
                        }
                    });
                }

                row.append(column);
            }

            table2.append(row);
        }

        tableDiv2.append(table2);

        //updates table1 with color coordinate
        function update(color) 
        {
            const display = coordDisplays[color];
            if(display) 
            {
                display.textContent = colorCoords[color].join(", ");
            }
        }
    }
</script>

<footer>
    <button onclick="window.print()" id="printButton">Print Page</button>
</footer>

</body>
</html>

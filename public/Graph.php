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
        .input{
            text-align: center;
            padding-top: 50px;
            color: #000000
        }
        table 
        {
            border-collapse: collapse;
            margin: 20px auto;
        }
        td 
        {
            width: 30px;
            height: 30px;
            border: 1px solid #000000;
        }
        .table1 
        {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        .table1 td 
        {
            border: 1px solid #000000;
            padding: 0.75rem;
            vertical-align: middle;
        }
        .table1 td:first-child 
        {
            width: 20%;
        }
        .table1 td:last-child 
        {
            width: 80%;
        }
        .table1 select 
        {
            width: 100px;
            margin-left: 10px;
        }
    </style>
</head>
<body>

<header>
    <h1>Graphing</h1>
</header>

<nav>
    <a href="/index.html">Home</a>
    <a href="About.php">About Us</a>
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

    <div 
        id="tableDiv">
    </div>
</div>

<script>
    document.getElementById("tableForm").addEventListener("submit", table);
    const colorChoices = ["Red", "Orange", "Yellow", "Green", "Blue", "Purple", "Grey", "Brown", "Black", "Teal"];
    let selectedColor = null; // default color that will not contain value until user selects a color

    function table(event)
    {
        //prevents reload
        event.preventDefault(); 

        const rows = parseInt(document.getElementById("rows").value);
        const columns = parseInt(document.getElementById("columns").value);
        const colorNum = parseInt(document.getElementById("colors").value);
        const tableDiv = document.getElementById("tableDiv");
        const table1 = document.createElement("table");

        //removes old table
        tableDiv.innerHTML = ""; 
        //table1 style
        table1.className = "table1";

        for(let i = 0; i < colorNum; i++) 
        {
            const row = document.createElement("tr");
            const left = document.createElement("td");
            const radio = document.createElement("input");
            const select = document.createElement("select");

            radio.type = "radio";
            radio.name = "selected";
            select.name = "colorSelect";

            //sector options
            for(let j = 0; j < colorChoices.length; j++) 
            {
                const option = document.createElement("option");
                option.textContent = colorChoices[j];
                select.append(option);
            }

            // Updates the color when you click the radio button
            radio.addEventListener("change", () => {
                selectedColor = select.value;
            });

            // Updates the color when you select a different option
            select.addEventListener("change", () => {
                if (radio.checked) {
                    selectedColor = select.value;
                }
            });

            left.append(radio);
            
            row.append(left);

            const right = document.createElement("td");
            right.append(select);
            row.append(right);
            table1.append(row);
        }
        tableDiv.append(table1);

        const colors = document.querySelectorAll('select[name="colorSelect"]');

        //color sector duplicate prevention
        function noDuplicates()
        {
            const currentColors = [];

            //gets colors currently selected
            for(let i = 0; i < colors.length; i++) 
            {
                currentColors.push(colors[i].value);
            }

            for(let i = 0; i < colors.length; i++) 
            {
                const select = colors[i];
                const selectedColor = currentColors[i];

                //makes sure options are clear before creating new one
                while(select.firstChild) 
                {
                    select.remove(select.firstChild);
                }

                //creates new selector without selected colors
                for(let j = 0; j < colorChoices.length; j++) 
                {
                    const color = colorChoices[j];
                    const colorLower = color.toLowerCase();

                    if(!currentColors.includes(colorLower) || colorLower === selectedColor) 
                    {
                        const option = document.createElement("option");
                        option.value = colorLower;
                        option.textContent = color;
                        if(colorLower === selectedColor) 
                        {
                            option.selected = true;
                        }
                        select.appendChild(option);
                    }
                }
            }
        }

        for(let i = 0; i < colors.length; i++) 
        {
            colors[i].addEventListener("change", noDuplicates);
        }

        noDuplicates();


        const table2 = document.createElement("table");
        table2.style.width ="100%";
        al = 65; // aschii alphabet character start number(IE A)
        al2= 65; // for the second alphabet charachter
        eal = 0;   // end of alphabet for the first A
        eal2 = 0; // end of alphabet for the second leter

        for(let i = 0; i <= rows; i++) 
        {
            const row = document.createElement("tr");
            
            for(let j = 0; j <= columns; j++) 
            {
                const column = document.createElement("td");
                
                // this addes the numbers in the rows
                if( j == 0 && i != 0){
                    const cell_text = document.createTextNode(`${i}`);
                    column.appendChild(cell_text);
                }

                // this adds the letters in the columns
                if(i==0 && j !=0 ){
                    if(eal == 0 ){
                        const cell_text = document.createTextNode(`${String.fromCharCode(al)}`);
                        column.appendChild(cell_text);
                        al++;
                    }
                    else if(eal == 1 ){
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
                    if (al2 > 90){
                        al2 = 65;
                        eal2= 1;
                    }
                }

                // Adds clicking functionality, ensures that the user needs to select a
                // color before clicking on the table
                column.addEventListener("click", () => {
                    if (selectedColor) {
                        column.style.backgroundColor = selectedColor.toLowerCase(); // Apply the selected color
                    } else {
                        alert("Please select a color from Table 1.");
                    }
                });
                row.append(column);
            }
            table2.append(row);
        }
        tableDiv.append(table2);
    }
</script>
</body>
</html>
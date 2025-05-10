<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Color Selection</title>
  <style>
    .content {
        margin-top: 10px;
        margin-bottom: 100px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    header {
        background: #B30000;
        color: #F5F5F5;
        padding: 0.5rem 0;
        text-align: center;
        font-size: large;
    }
    
    .content h1 {
        margin-top: 1.75rem;
    }

    .logo {
        display: inline;
        margin-top: 2rem;
    }

    .content p {
        margin-top: 1.5rem;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        line-height: 1.6;
        background-color: #F5F5F5;
        color: #B30000;
    }

    nav {
        background: #B30000;
        padding: 0.5rem;
        text-align: center;
    }

    nav a {
        display: inline-block;
        background: #F5F5F5;
        color: #B30000;
        text-decoration: none;
        padding: 0.5rem 1rem;
        margin: 0 0.5rem;
        border-radius: 25px;
        font-weight: bold;
        transition: background 0.3s ease, color 0.3s ease;
    }
    nav a:hover {
        background:#B30000;
        color: #F5F5F5;
    }
    
    h1, h2 {
        text-align: center;
    }

    form {
        background: #fff;
        padding: 1em;
        margin: 2em auto;
        border-radius: 8px;
        box-shadow: 0 0 8px #ccc;
        max-width: 600px;
        text-align: center;
    }

    input[type="text"], select {
        margin: 0.5em;
        width: 200px;
        padding: 0.3em;
    }

    input[type="submit"], button {
        padding: 0.5em 1em;
        font-weight: bold;
        margin-top: 1em;
    }

    .error {
        color: red;
        font-style: italic;
        display: block;
        margin-top: 5px;
    }

  </style>
</head>
<body>
<header>
    <h1>Color Selection</h1>
</header>

<nav>
    <a href="/index.html">Home</a>
    <a href="About.php">About Us</a>
    <a href="Graph.php">Graphing</a>
</nav>

<!--Add-->
<form id="addForm">
    <h2>Add New Color</h2>
    <input type="text" placeholder="Color Name" id="addName" required>
    <input type="text" placeholder="#RRGGBB" id="addHex" required pattern="^#[A-Fa-f0-9]{6}$">
    <input type="submit" value="Add Color">
    <span class="error" id="addError"></span>
</form>

<!--Edit-->
<form id="editForm">
    <h2>Edit Color</h2>
    <select id="editSelect"></select><br><br>
    <input type="text" placeholder="New Name" id="editName" required>
    <input type="text" placeholder="New Hex" id="editHex" required pattern="^#[A-Fa-f0-9]{6}$">
    <input type="submit" value="Update Color">
    <span class="error" id="editError"></span>
</form>

<!--Delete-->
<form id="deleteForm">
    <h2>Delete Color</h2>
    <select id="deleteSelect"></select>
    <button type="submit">Delete Color</button>
    <span class="error" id="deleteError"></span>
</form>

<script>
    const defaultColors = [
        { name: 'Red', hex: '#FF0000' },
        { name: 'Orange', hex: '#FFA500' },
        { name: 'Yellow', hex: '#FFFF00' },
        { name: 'Green', hex: '#008000' },
        { name: 'Blue', hex: '#0000FF' },
        { name: 'Purple', hex: '#800080' },
        { name: 'Grey', hex: '#808080' },
        { name: 'Brown', hex: '#A52A2A' },
        { name: 'Black', hex: '#000000' },
        { name: 'Teal', hex: '#008080' }
    ];

    function loadColors() 
    {
        const stored = localStorage.getItem('colors');
        if(!stored) 
        {
        localStorage.setItem('colors', JSON.stringify(defaultColors));
        return defaultColors;
        }
        return JSON.parse(stored);
    }

    function saveColors(colors) 
    {
        localStorage.setItem('colors', JSON.stringify(colors));
    }

    function updateDropdowns() 
    {
        const colors = loadColors();
        const editSelect = document.getElementById('editSelect');
        const deleteSelect = document.getElementById('deleteSelect');
        editSelect.innerHTML = '';
        deleteSelect.innerHTML = '';
        colors.forEach((c, i) => {
        const opt1 = new Option(`${c.name} (${c.hex})`, i);
        const opt2 = new Option(`${c.name} (${c.hex})`, i);
        editSelect.add(opt1);
        deleteSelect.add(opt2);
        });
    }

    document.getElementById('addForm').addEventListener('submit', e => {
        e.preventDefault();
        const name = document.getElementById('addName').value.trim();
        const hex = document.getElementById('addHex').value.trim();
        const error = document.getElementById('addError');
        error.textContent = '';
        const colors = loadColors();

        if(colors.some(c => c.name.toLowerCase() === name.toLowerCase() || c.hex.toLowerCase() === hex.toLowerCase())) 
        {
        error.textContent = 'Name or hex already exists.';
        return;
        }

        colors.push({ name, hex });
        saveColors(colors);
        updateDropdowns();
        document.getElementById('addForm').reset();
    });

    document.getElementById('editForm').addEventListener('submit', e => {
        e.preventDefault();
        const index = document.getElementById('editSelect').value;
        const name = document.getElementById('editName').value.trim();
        const hex = document.getElementById('editHex').value.trim();
        const error = document.getElementById('editError');
        error.textContent = '';
        const colors = loadColors();

        if(colors.some((c, i) => i != index && (c.name.toLowerCase() === name.toLowerCase() || c.hex.toLowerCase() === hex.toLowerCase()))) 
        {
            error.textContent = 'Name or hex already exists.';
            return;
        }

        colors[index] = { name, hex };
        saveColors(colors);
        updateDropdowns();
        document.getElementById('editForm').reset();
    });

    document.getElementById('deleteForm').addEventListener('submit', e => {
        e.preventDefault();
        const index = document.getElementById('deleteSelect').value;
        const error = document.getElementById('deleteError');
        error.textContent = '';
        const colors = loadColors();

        if(colors.length <= 2) 
        {
        error.textContent = 'At least 2 colors must remain.';
        return;
        }

        if(!confirm('Are you sure you want to delete this color?')) return;

        colors.splice(index, 1);
        saveColors(colors);
        updateDropdowns();
    });

    updateDropdowns();
</script>
</body>
</html>

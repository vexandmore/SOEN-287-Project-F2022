// Data being used for the colouring of table cells
const colourThresholds = {
    "standard-deviation": null,
    "rank": new Categorizer([50, 15, 1], ["table-danger", "table-warning", "table-success"], "lowest"),
    "percentile": new Categorizer([20, 50, 100], ["table-danger", "table-warning", "table-success"], "highest")
};

var xmlhttp = new XMLHttpRequest();
xmlhttp.onload = function() {
    const allData = JSON.parse(this.responseText);
    // Grab data for student "Sophie"
    const studentData = allData.studentData.filter(val => val.name == "Sophie")[0];
    // Grab median data
    const medianData = allData.assignments;
    /**
     * Create the report table with the median grades
     */
    const medianReport = medianData.map(assignment => [assignment.name, assignment.median]);
    // Make and insert the table into the appropriate section
    addToTable('mediansTable', medianReport);
    /**
     * Make table for report with standard deviation, rank, percentile
     * NOTE: uses the custom TableElement class to bundle data about what 
     * the class of the <td> should be
     */

    const dataReport = [
        // Add the report values to this array, to be turned into a table
        Object.keys(studentData.report).map(key => {
            const value = studentData.report[key];
            // If there is a categorizer for this report piece, categorize it
            if (colourThresholds[key]) {
                var className = colourThresholds[key].classify(value);
            }
            return new TableElement(value, className);
        })
    ];

    // Insert table data
    addToTable('statisticsTable', dataReport);
}
xmlhttp.open("GET", "api/studentData.php", true);
xmlhttp.send();





/**
 * Create the report table with standard deviation, rank, and percentile.
 */

// Constructor of object that will categorize a rank or percentile into the appropriate
// table colour class to show in the report
function Categorizer(numbers, classes, best) {
    this.numbers = numbers;
    this.classes = classes;
    this.compare = best == "highest" ? (x,y) => x <= y : (x,y) => y <= x;
    
    this.classify = function(num) {
        for (var i = 0; i < numbers.length; i++) {
            if (this.compare(num, this.numbers[i])) {
                return classes[i];
            }
        }
        throw new Error("number " + num + " out of range " + numbers);
    }
}

function TableElement(text, className) {
    this.text = text;
    this.className = className;
    this.toString = () => this.text;
}

function addToTable(tableID, elements) {
    // get table body element
    const table = document.querySelector("#" + tableID + " tbody");
    // Do each row
    for (var i = 0; i < elements.length; i++) {
        const tr = document.createElement("tr");
        // For each element in the row, make the td and add it to the row
        elements[i].forEach(e => {
            const text = document.createTextNode(e.toString());
            const td = document.createElement("td");
            td.className = e.className;
            td.appendChild(text);
            tr.appendChild(td);
        });
        table.appendChild(tr);
    }
}

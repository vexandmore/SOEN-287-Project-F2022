const colourThresholds = {
    "standard-deviation": null,
    "rank": new Categorizer([50, 15, 1], ["table-danger", "table-warning", "table-success"], "lowest"),
    "percentile": new Categorizer([20, 50, 100], ["table-danger", "table-warning", "table-success"], "highest")
};

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

function makeTable(elements) {
    const table = document.createElement("table");
    table.className = "table";
    // Do header row
    const thead = document.createElement("thead");
    const tbody = document.createElement("tbody");
    
    const tr1 = document.createElement("tr");
    elements[0].forEach(e => {
        const text = document.createTextNode(e.toString());
        const th = document.createElement("th");
        th.appendChild(text);
        th.scope = "col";
        th.className = e.className;
        tr1.appendChild(th);
    });
    thead.appendChild(tr1);

    // Do remaining rows
    for (var i = 1; i < elements.length; i++) {
        const tr = document.createElement("tr");
        elements[i].forEach(e => {
            const text = document.createTextNode(e.toString());
            const td = document.createElement("td");
            td.className = e.className;
            td.appendChild(text);
            tr.appendChild(td);
        });
        tbody.appendChild(tr);
    }
    // Add table head and body    
    table.appendChild(thead);
    table.appendChild(tbody);
    return table;
}

/**
 * Make table for report with standard deviation, etc
 */

const dataReport = [["Standard Deviation", "Rank", "Percentile"],
    // Add the report values to this array, to be turned into a table
    Object.keys(studentReport.report).map(key => {
        const value = studentReport.report[key];
        // If there is a categorizer for this report piece, categorize it
        if (colourThresholds[key]) {
            var className = colourThresholds[key].classify(value);
        }
        return new TableElement(value, className);
    })
];

// Make and insert the table into the appropriate section
tableStats = makeTable(dataReport);
const statsSection = document.getElementById("reportStatistics");
statsSection.insertAdjacentElement('afterend', tableStats);


/**
 * Create the report table with the median grades
 */
const medianReport = [["Assignment", "Median"]].concat(
    studentReport.assignments.map(assignment => [assignment.name, assignment.median])
);
// Make and insert the table into the appropriate section
const tableMedian = makeTable(medianReport);
const mediansSection = document.getElementById("reportMedians");
mediansSection.insertAdjacentElement('afterend', tableMedian);

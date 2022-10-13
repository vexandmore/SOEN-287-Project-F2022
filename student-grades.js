var reportSection = document.getElementById("report");
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

const tableStats = document.createElement("table");
tableStats.className = "table";
const tr1 = document.createElement("tr");
// Append the headings to the first row
["Standard Deviation", "Rank", "Percentile"].map(x => {
    const text = document.createTextNode(x);
    const th = document.createElement("th");
    th.appendChild(text);
    th.scope = "col";
    return th;
}).forEach(heading => tr1.appendChild(heading));
// Append the data to the second row
const tr2 = document.createElement("tr");
const element = studentReport.report;

// Create the table element for each item in the report
for (const reportElement in studentReport.report) {
    const value = studentReport.report[reportElement]
    const text = document.createTextNode(value);
    const td = document.createElement("td");
    // If there is a categorizer for this report element,
    // categorize the number
    if (colourThresholds[reportElement]) {
        const tableClass = colourThresholds[reportElement].classify(value);
        td.className = tableClass;
    }
    td.appendChild(text);
    tr2.appendChild(td);
}
// Create the report table
const thead = document.createElement("thead");
thead.appendChild(tr1);
const tbody = document.createElement("tbody");
tbody.appendChild(tr2);
tableStats.appendChild(thead);
tableStats.appendChild(tbody);

reportSection.insertAdjacentElement('beforeend', tableStats);




/**
 * Create the report table with the median grades
 */
 const tableMedian = document.createElement("table");
 tableMedian.className = "table";
 const trs1 = document.createElement("tr");
 const medianRows = [];
 
 ["Assignment", "Median"].map(x => {
    const text = document.createTextNode(x);
    const th = document.createElement("th");
    th.appendChild(text);
    th.scope = "col";
    return th;
}).forEach(heading => trs1.appendChild(heading));

// Add the medians to the table
studentReport.assignments.forEach(assignment => {
    const trs2 = document.createElement("tr");
    const nameE = document.createElement("td");
    nameE.appendChild(document.createTextNode(assignment.name));
    const medianE = document.createElement("td");
    medianE.appendChild(document.createTextNode(assignment.median));
    trs2.appendChild(nameE);
    trs2.appendChild(medianE);
    medianRows.push(trs2);
});

// Create the report table
// Create the report table
const theadM = document.createElement("thead");
theadM.appendChild(trs1);
const tbodyM = document.createElement("tbody");
medianRows.forEach(row => {
    tbodyM.appendChild(row);
});
tableMedian.appendChild(theadM);
tableMedian.appendChild(tbodyM);
reportSection.insertAdjacentElement('beforeend', tableMedian);

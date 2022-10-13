var reportSection = document.getElementById("report");
const colourThresholds = {
    "standard-deviation": null,
    "rank": new Categorizer([50, 15, 1], ["table-danger", "table-warning", "table-success"], "lowest"),
    "percentile": new Categorizer([20, 50, 100], ["table-danger", "table-warning", "table-success"], "highest")
};
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

const table = document.createElement("table");
table.className = "table";
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


const thead = document.createElement("thead");
thead.appendChild(tr1);
const tbody = document.createElement("tbody");
tbody.appendChild(tr2);
table.appendChild(thead);
table.appendChild(tbody);

reportSection.insertAdjacentElement('beforeend', table);


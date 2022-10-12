var demoGrades = {
    "assignments": [
    {"name": "Assignment 1", "grade": 80, "standard-deviation": 12, "median": 80, "rank": 15, "percentile": 90},
    {"name": "Assignment 2", "grade": 75, "standard-deviation": 5, "median": 75, "rank": 30, "percentile": 50}]
};

var gradesSection = document.getElementById("grades");

demoGrades.assignments.forEach(element => {
    const assignmentName = document.createTextNode(element.name);
    const heading = document.createElement("h3");
    heading.appendChild(assignmentName);

    const br = document.createElement("br");

    const table = document.createElement("table");
    const tr1 = document.createElement("tr");
    // Append the headings to the first row
    ["Standard Deviation", "Median", "Rank", "Percentile"].map(x => {
        const text = document.createTextNode(x);
        const th = document.createElement("th");
        th.appendChild(text);
        return th;
    }).forEach(heading => tr1.appendChild(heading));
    // Append the data to the second row
    const tr2 = document.createElement("tr");
    [element["standard-deviation"], element["median"], element["rank"], element["percentile"]].map(e => {
        const text = document.createTextNode(e);
        const td = document.createElement("td");
        td.appendChild(text);
        return td;
    }).forEach(cell => tr2.appendChild(cell));

    table.appendChild(tr1);
    table.appendChild(tr2);

    gradesSection.insertAdjacentElement('beforeend', heading);
    gradesSection.insertAdjacentElement('beforeend', br);
    gradesSection.insertAdjacentElement('beforeend', table);
});
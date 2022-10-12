var reportSection = document.getElementById("report");

const table = document.createElement("table");
const tr1 = document.createElement("tr");
// Append the headings to the first row
["Standard Deviation", "Rank", "Percentile"].map(x => {
    const text = document.createTextNode(x);
    const th = document.createElement("th");
    th.appendChild(text);
    return th;
}).forEach(heading => tr1.appendChild(heading));
// Append the data to the second row
const tr2 = document.createElement("tr");
const element = studentReport.report;
[element["standard-deviation"], element["rank"], element["percentile"]].map(e => {
    const text = document.createTextNode(e);
    const td = document.createElement("td");
    td.appendChild(text);
    return td;
}).forEach(cell => tr2.appendChild(cell));

table.appendChild(tr1);
table.appendChild(tr2);

reportSection.insertAdjacentElement('beforeend', table);


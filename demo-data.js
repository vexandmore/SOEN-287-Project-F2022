{
    const data = {
        "studentData":
        [{
            "name": "William",
            "assignments": [
            {"name": "Assignment 1", "grade": 80},
            {"name": "Assignment 2", "grade": 75},
            {"name": "Assignment 3", "grade": 95}],
            report: {"standard-deviation": 14, "rank": 20, "percentile": 51}
        },
        {
            "name": "Sophie",
            "assignments": [
            {"name": "Assignment 1", "grade": 88},
            {"name": "Assignment 2", "grade": 70},
            {"name": "Assignment 3", "grade": 92}],
            report: {"standard-deviation": 15, "rank": 18, "percentile": 51}
        }],
        "assignments": [{"name": "Assignment 1", "median": 74}, {"name": "Assignment 2", "median": 80},
                        {"name": "Assignment 3", "median": 82}]
    };
    // Put demo data in localstorage
    localStorage.setItem("data", JSON.stringify(data));
}
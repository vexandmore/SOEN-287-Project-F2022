{
    const data = {
        "studentData":
        [{
            "name": "William",
            "assignments": [
            {"name": "Assignment 1", "grade": 80, "median": 75},
            {"name": "Assignment 2", "grade": 75, "median": 62},
            {"name": "Assignment 3", "grade": 95, "median": 95}],
            report: {"standard-deviation": 14, "rank": 20, "percentile": 51}
        },
        {
            "name": "Sophie",
            "assignments": [
            {"name": "Assignment 1", "grade": 88, "median": 75},
            {"name": "Assignment 2", "grade": 70, "median": 62},
            {"name": "Assignment 3", "grade": 92, "median": 95}],
            report: {"standard-deviation": 15, "rank": 18, "percentile": 51}
        }],
        "assignments": ["Assignment 1", "Assignment 2", "Assignment 3"]
    };
    
    localStorage.setItem("data", JSON.stringify(data));
}
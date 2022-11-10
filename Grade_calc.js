// Function for calculating grades
const calculate = () => {
  
    // Getting input from user into height variable.
    let assignment1 = document.querySelector("#assignment1").value;
    let assignment2 = document.querySelector("#assignment2").value;
    let midterm = document.querySelector("#midterm").value;
    let final = document.querySelector("#final").value;
    let grades = "";
    
    // Input is string so typecasting is necessary. */
    let totalgrades =
      parseFloat(assignment1*0.1) +
      parseFloat(assignment2*0.1) +
      parseFloat(midterm*0.3) +
      parseFloat(final*0.5);
    
    // Checking the condition for the providing the 
    // grade to student based on percentage
    let percentage = (totalgrades);
    if (percentage <= 100 && percentage >= 90) {
      grades = "A+";
    } else if (percentage <= 89 && percentage >= 85) {
        grades = "A";
    } else if (percentage <= 84 && percentage >= 80) {
      grades = "A-";
    } else if (percentage <= 79 && percentage >= 77) {
        grades = "B+";
      } else if (percentage <= 76 && percentage >= 73) {
        grades = "B";
      } else if (percentage <= 72 && percentage >= 70) {
        grades = "B-";
      } else if (percentage <= 69 && percentage >= 67) {
        grades = "C+";
      } else if (percentage <= 66 && percentage >= 63) {
        grades = "C";
      } else if (percentage <= 62 && percentage >= 60) {
        grades = "C-";
    } else if (percentage <= 59 && percentage >= 57) {
      grades = "D+";
    } else if (percentage <= 56 && percentage >= 53) {
        grades = "D";
      } else if (percentage <= 52 && percentage >= 50) {
        grades = "D-";
      } else if (percentage <= 49 && percentage >= 0) {
        grades = "F";
      } else if (percentage >=100.1) {
      grades = "not available";
    }
    // Checking the values are empty if empty than
    // show please fill them
    if (assignment1 == "" || assignment2 == "" 
              || midterm == "" || final == "") {
      document.querySelector("#showdata").innerHTML
           = "Please enter all the fields";
    } else {
    
      // Checking the condition for the fail and pass
      if (percentage <= 100 && percentage >= 50) {
        document.querySelector(
          "#showdata"
        ).innerHTML = 
          ` The percentage is ${percentage}% out of 100%. <br> 
          The grade is ${grades}. Student passed. `;
      } 
      else if (percentage <= 49.9) {
        document.querySelector(
          "#showdata"
        ).innerHTML = 
          ` The percentage is ${percentage}% out of 100%. <br> 
          The grade is ${grades}. Student failed. `;
         } 
         else if (percentage >= 100.1) {
            document.querySelector(
         "#showdata"
        ).innerHTML = 
          `Error. The grade is ${grades}. <br>
          Please type all the grades over 100%. `;
      }
    }
  };
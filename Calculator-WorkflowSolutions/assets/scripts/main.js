class Calculator {
	constructor(equationTextElement, resultTextElement) {
		this.equationTextElement = equationTextElement;
		this.resultTextElement = resultTextElement;
		this.isFirstAction = true;
		this.clear();
	}

	clear() {
		this.equation = "";
		this.isFirstAction = true;
		this.result = "";
	}

	delete() {
		this.equation = this.equation.toString().slice(0, -1);
	}

	appendNumbersToEquation(char) {
		const lastNumber = this.getLastEnteredNumber();

		if (isNaN(char) && char !== ".") return;

		if (char === "." && lastNumber.includes(".")) return;

		this.equation = this.equation.toString() + char.toString();
	}

	getLastEnteredNumber() {
		return this.equation.split(" ").pop();
	}

	appendOperationToEquation(operation) {
		if (this.equation === "") return;
		this.compute();

		const operationChar = " " + operation + " ";

		this.equation = this.equation.toString() + operationChar.toString();
	}

	compute() {
		let result;

		if (this.isFirstAction) {
			this.isFirstAction = false;
		} else {
			result = eval(this.equation.toString());
		}

		this.result = result;
	}

	updateDisplay() {
		this.equationTextElement.innerText = this.equation;
		if (!this.result !== undefined) {
			this.resultTextElement.innerText = this.result;
		}
	}

	saveEquation() {
		//save equation 2 ways
		//Vanila JS Way Below obviously with locahost will encounter CORS (Cross Origin Resource Sharing) Error

		var link = "localhost:8080/calc"; // obviously here will include the link to our APi handler
		var xhttp = new XMLHttpRequest();

		var data = "?equation=" + this.equation + "result=" + this.result;

		xhttp.open("POST", link, true);
		xhttp.setRequestHeader(
			"Content-type",
			"application/x-www-form-urlencoded"
		);

		var result = JSON.parse(xhttp.send("?equation=1+2&result=3")); // obviously we will get the data from querySelect on the equation and result

		/*
			FROM HERE WE Will call our method to refresh render and display the saved equaitons which could be div with a transformy(-100%) css and display:none
			which we could toggle animete in with @keyframes. It will also work with the api, and send a get request to it to fetch a most likely paginated 
			list of all save equations. I have implemented a parent_id element and edited date, which could create a recursive hierarchy back to origin equation
		*/

		//ES6 way  - as far as I know this is not supported on most mobile views for android, as well as poor ol' IE
		/*
		const link = "localhost:8080/prev-calc"; // obviously here will include the link to our APi handler
		const data = {equation: this.eqation.toString(), result: this.result.toString()}; //!TODO obviously we need to configure the api to diferentiate between inputs were they JSON, Form data etc.

		await fetch(link, {
			method: "POST",
			cache: "no-cache",
			redirect: "follow",
			body: data.Stringify(),
			headers: {
				"Content-Type": "application/json; charset=utf-8"
			}
		})
			.then((res) => res.json()) // parse response as JSON  or could be parse.text() for plain response
			.then((response) => {
				"";
			})
			.catch((err) => {
				console.log("Server Error: -S", log);
				alert("Sorry, there are no results for your search");
			});
			*/
	}
}

const app = () => {
	const numberButtons = document.querySelectorAll("[data-number]");
	const operationButtons = document.querySelectorAll("[data-operation]");
	//const bracketButtons = document.querySelectorAll("[data-bracket]"); !TODO implement at a future point
	const equalsButton = document.querySelector("[data-equals]");
	const deleteButton = document.querySelector("[data-delete]");
	const allClearButton = document.querySelector("[data-all-clear]");
	const resultTextElement = document.querySelector("[data-result]");
	const equationTextElement = document.querySelector("[data-equation]");

	const calculator = new Calculator(resultTextElement, equationTextElement);

	numberButtons.forEach((button) => {
		button.addEventListener("click", () => {
			calculator.appendNumbersToEquation(button.innerText);
			calculator.updateDisplay();
		});
	});

	operationButtons.forEach((button) => {
		button.addEventListener("click", () => {
			calculator.appendOperationToEquation(button.innerText);
			calculator.updateDisplay();
		});
	});

	equalsButton.addEventListener("click", (button) => {
		calculator.compute();
		calculator.updateDisplay();
		//here we use the calculator.saveEqaution()
	});

	allClearButton.addEventListener("click", (button) => {
		calculator.clear();
		calculator.updateDisplay();
	});

	deleteButton.addEventListener("click", (button) => {
		calculator.delete();
		calculator.updateDisplay();
	});

	toggleNumPad();
	listenForKeyInputs(calculator);
};

const toggleNumPad = () => {
	const numPad = document.querySelector(".numpad");

	numPad.addEventListener("click", () => {
		numPad.classList.toggle("on");
	});
};

const listenForKeyInputs = (Calculator) => {
	const numPad = document.querySelector(".numpad");

	document.addEventListener("keyup", (e) => {
		if (numPad.classList.contains("on")) {
			switch (e.key) {
				case "0":
					Calculator.appendNumbersToEquation("0");
					Calculator.updateDisplay();
					break;
				case "1":
					Calculator.appendNumbersToEquation("1");
					Calculator.updateDisplay();
					break;
				case "2":
					Calculator.appendNumbersToEquation("2");
					Calculator.updateDisplay();
					break;
				case "3":
					Calculator.appendNumbersToEquation("3");
					Calculator.updateDisplay();
					break;
				case "4":
					Calculator.appendNumbersToEquation("4");
					Calculator.updateDisplay();
					break;
				case "5":
					Calculator.appendNumbersToEquation("5");
					Calculator.updateDisplay();
					break;
				case "6":
					Calculator.appendNumbersToEquation("6");
					Calculator.updateDisplay();
					break;
				case "7":
					Calculator.appendNumbersToEquation("7");
					Calculator.updateDisplay();
					break;
				case "8":
					Calculator.appendNumbersToEquation("8");
					Calculator.updateDisplay();
					break;
				case "9":
					Calculator.appendNumbersToEquation("8");
					Calculator.updateDisplay();
					break;
				case "*":
					Calculator.appendOperationToEquation("*");
					Calculator.updateDisplay();
					break;
				case "/":
					Calculator.appendOperationToEquation("/");
					Calculator.updateDisplay();
					break;
				case "-":
					Calculator.appendOperationToEquation("-");
					Calculator.updateDisplay();
					break;
				case "+":
					Calculator.appendOperationToEquation("+");
					Calculator.updateDisplay();
					break;
				case "Enter":
					Calculator.compute();
					Calculator.updateDisplay();
				case ".":
					Calculator.appendNumbersToEquation(".");
					Calculator.updateDisplay();
					break;
				case "Escape":
					Calculator.clear();
					Calculator.updateDisplay();
				case "Delete":
					Calculator.clear();
					Calculator.updateDisplay();
				case "Backspace":
					Calculator.delete();
					Calculator.updateDisplay();

				default:
					break;
			}
		}
	});
};

app();

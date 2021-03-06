//  JavaScript to make submissions

function displayResult(responseObj)
{
    let result = document.getElementById('result');
    let verdict = document.getElementById('verdict');
    let resultBox = document.getElementsByClassName('result-box');
    let verdict_img;

    if(responseObj.status.description === "Accepted")
        verdict_img = "<img src='../public/images/correct-icon.png'>";
    else if(responseObj.status.description === "Compilation Error")
        verdict_img = "<img src='../public/images/compilation-icon.png'>";
    else if(responseObj.status.description === "Wrong Answer")
        verdict_img = "<img src='../public/images/wrong-icon.png'>";

    verdict.innerHTML = "<h1>" + responseObj.status.description + "</h1>" + verdict_img;

    if(responseObj.status.description === "Accepted")
    {
        result.innerHTML =    "<img src='../public/images/clock-icon.png'>" + responseObj.time + " sec<br/>"
                            + "<img src='../public/images/memory-icon.png'>" + responseObj.memory + " kB<br/>"
                            + "<img src='../public/images/output-icon.png'>" + responseObj.stdout.substr(0,10) + "...";

        verdict.style.width = result.style.width = "50%";
    }
    else
    {
        result.innerHTML = "";
        verdict.style.width = "100%";
        result.style.width = "0";
    }

    resultBox[0].style.visibility = "visible";
}

function submit()
{
    let file = document.getElementById('solution').files[0];
    let fileType = document.getElementById('fileType').value;
    let reader = new FileReader();
    let stdin = document.getElementById('stdin').value;
    let expected_out = document.getElementById('stdout');
    let langType;

    switch (fileType) {
        case 'C++':
                    langType = 12;
                    break;
        case 'Java':
                    langType = 27;
                    break;
        default:
                    langType = 43;
    }

    reader.onload = function () {
        let request = {
            source_code: reader.result,
            language_id: langType,
            stdin: stdin
        };

        if(expected_out.value)
            request.expected_output = expected_out.value;

        // get token for submission
        let xhrToken = new XMLHttpRequest();
        xhrToken.open("POST", "https://api.judge0.com/submissions/?base64_encoded=false&wait=false");
        xhrToken.responseType = 'json';
        xhrToken.setRequestHeader("Content-type", "application/json");
        xhrToken.send(JSON.stringify(request));

        xhrToken.onreadystatechange = function() {
            if(xhrToken.readyState === XMLHttpRequest.DONE) {
                console.log(xhrToken.response);

                // get submission result
                let submissionToken = xhrToken.response.token;
                let xhr = new XMLHttpRequest();
                xhr.responseType = 'json';
                xhr.open("GET", "https://api.judge0.com/submissions/" + submissionToken + "?fields=stdout,stderr,status,memory,time");
                xhr.setRequestHeader("Content-type", "application/json");
                xhr.send();

                xhr.onreadystatechange = function() {
                    if(xhr.readyState === XMLHttpRequest.DONE) {
                        console.log(xhr.response);

                        if(xhr.response.status.description === "Processing" || xhr.response.status.description === "In Queue")
                            setTimeout(function() {
                                xhr.open("GET", "https://api.judge0.com/submissions/" + submissionToken + "?fields=stdout,stderr,status,memory,time");
                                xhr.setRequestHeader("Content-type", "application/json");
                                xhr.send();
                            }, 1000);
                        else
                            displayResult(xhr.response);
                    }
                };
            }
        };
    };

    reader.readAsText(file);
}

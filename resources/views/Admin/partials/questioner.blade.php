<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f0f0f0;
    }

    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
    }

    .modal-content {
        background-color: white;
        margin: 15% auto;
        padding: 20px;
        width: 70%;
        max-width: 600px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .question-group {
        margin-bottom: 20px;
        padding: 15px;
        background-color: #f8f8f8;
        border-radius: 5px;
    }

    h2 {
        color: #c00;
        margin-top: 0;
    }

    .close-btn {
        float: right;
        cursor: pointer;
        font-size: 24px;
    }

    button {
        background-color: #c00;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        margin: 5px;
    }

    button:hover {
        background-color: #a00;
    }

    .question {
        margin-bottom: 15px;
        display: none; /* Hide all questions by default */
    }

    .question.active {
        display: block; /* Show only the active question */
    }

    label {
        display: block;
        margin: 8px 0;
    }

    .navigation-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
</style>

<div class="modal-overlay" id="questionnaireModal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h2>Fire Alarm Acknowledgment</h2>
        <form id="alarmQuestionnaire" onsubmit="submitForm(event)">
            <div class="question-group">
                <!-- Question 1 -->
                <div class="question active" data-question="1">
                    <p>1. Have you received the fire alarm notification?</p>
                    <label>
                        <input type="radio" name="q1" value="yes"> Yes
                    </label>
                    <label>
                        <input type="radio" name="q1" value="no"> No
                    </label>
                </div>

                <!-- Question 2 -->
                <div class="question" data-question="2">
                    <p>2. Have you initiated emergency procedures?</p>
                    <label>
                        <input type="radio" name="q2" value="yes"> Yes
                    </label>
                    <label>
                        <input type="radio" name="q2" value="no"> No
                    </label>
                </div>

                <!-- Question 3 -->
                <div class="question" data-question="3">
                    <p>3. Is the building being evacuated?</p>
                    <label>
                        <input type="radio" name="q3" value="yes"> Yes
                    </label>
                    <label>
                        <input type="radio" name="q3" value="no"> No
                    </label>
                </div>

                <!-- Question 4 -->
                <div class="question" data-question="4">
                    <p>4. Have emergency services been contacted?</p>
                    <label>
                        <input type="radio" name="q4" value="yes"> Yes
                    </label>
                    <label>
                        <input type="radio" name="q4" value="no"> No
                    </label>
                </div>

                <!-- Question 5 -->
                <div class="question" data-question="5">
                    <p>5. Is the fire alarm system functioning properly?</p>
                    <label>
                        <input type="radio" name="q5" value="yes"> Yes
                    </label>
                    <label>
                        <input type="radio" name="q5" value="no"> No
                    </label>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="navigation-buttons">
                <button type="button" onclick="previousQuestion()">Previous</button>
                <button type="button" onclick="nextQuestion()">Next</button>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="submitButton" style="display: none;">Submit Acknowledgment</button>
        </form>
    </div>
</div>

<script>
    let currentQuestion = 1;
    const totalQuestions = 5; // Total number of questions

    // Open modal when "Acknowledge" button is clicked
    function openModal() {
        document.getElementById('questionnaireModal').style.display = 'block';
        resetQuestionnaire(); // Reset the questionnaire when opened
    }

    // Close modal
    function closeModal() {
        document.getElementById('questionnaireModal').style.display = 'none';
    }

    // Show the current question and hide others
    function showQuestion(questionNumber) {
        const questions = document.querySelectorAll('.question');
        questions.forEach((question) => {
            question.classList.remove('active');
        });
        document.querySelector(`.question[data-question="${questionNumber}"]`).classList.add('active');

        // Show/hide navigation buttons
        document.getElementById('submitButton').style.display = questionNumber === totalQuestions ? 'block' : 'none';
        document.querySelector('.navigation-buttons').style.display = questionNumber === totalQuestions ? 'none' : 'flex';
    }

    function nextQuestion() {
        if (currentQuestion < totalQuestions) {
            currentQuestion++;
            showQuestion(currentQuestion);
        }
    }

    // Go to the previous question
    function previousQuestion() {
        if (currentQuestion > 1) {
            currentQuestion--;
            showQuestion(currentQuestion);
        }
    }

    // Reset the questionnaire
    function resetQuestionnaire() {
        currentQuestion = 1;
        showQuestion(currentQuestion);
        document.getElementById('alarmQuestionnaire').reset();
    }

    // Form submission
    function submitForm(event) {
        event.preventDefault();
        
        // Get all answers
        const q1 = document.querySelector('input[name="q1"]:checked');
        const q2 = document.querySelector('input[name="q2"]:checked');
        const q3 = document.querySelector('input[name="q3"]:checked');
        const q4 = document.querySelector('input[name="q4"]:checked');
        const q5 = document.querySelector('input[name="q5"]:checked');

        // Validate all questions answered
        if (!q1 || !q2 || !q3 || !q4 || !q5) {
            alert('Please answer all questions before submitting.');
            return;
        }

        // Collect responses
        const responses = {
            question1: q1.value,
            question2: q2.value,
            question3: q3.value,
            question4: q4.value,
            question5: q5.value
        };

        // Here you would typically send the data to a server
        console.log('Responses:', responses);
        
        // Close modal and reset form
        closeModal();
        resetQuestionnaire();
        alert('Thank you for submitting your acknowledgment!');
    }

    // Close modal if clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('questionnaireModal');
        if (event.target === modal) {
            closeModal();
        }
    };
</script>


    


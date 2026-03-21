<?php
/**
 * Template Name: Skills Test Page
 *
 * Interactive skill assessment with quiz interface
 *
 * @package JobPortal
 */

get_header();

if (!is_user_logged_in()) {
    ?>
    <div class="jobportal-container" style="padding: 80px 20px; text-align: center;">
        <h1 style="font-size: 48px; font-weight: 800; color: #1e293b; margin-bottom: 16px;">Skills Assessment</h1>
        <p style="font-size: 18px; color: #64748b; margin-bottom: 32px;">Please login to take skill tests and earn certificates.</p>
        <a href="<?php echo wp_login_url(get_permalink()); ?>" class="jobportal-btn jobportal-btn-primary">
            Login to Continue
        </a>
    </div>
    <?php
    get_footer();
    exit;
}

$skill = isset($_GET['skill']) ? sanitize_text_field($_GET['skill']) : 'javascript';
$quizzes = jobportal_get_skill_quizzes();

if (!isset($quizzes[$skill])) {
    echo '<div class="jobportal-container" style="padding: 80px 20px;"><p>Invalid skill test.</p></div>';
    get_footer();
    exit;
}

$quiz = $quizzes[$skill];
$user_id = get_current_user_id();
$current_user = wp_get_current_user();
?>

<div class="jobportal-container" style="padding: 40px 20px;">
    <!-- Quiz Header -->
    <div id="quiz-header" style="
        background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
        padding: 40px;
        border-radius: 20px;
        color: white;
        margin-bottom: 40px;
        box-shadow: 0 8px 32px rgba(79, 172, 254, 0.3);
    ">
        <div style="max-width: 800px; margin: 0 auto;">
            <h1 style="font-size: 42px; font-weight: 800; margin-bottom: 12px; color: white;">
                <?php echo esc_html($quiz['title']); ?> Assessment
            </h1>
            <p style="font-size: 18px; opacity: 0.95; margin-bottom: 24px;">
                <?php echo esc_html($quiz['description']); ?>
            </p>
            <div style="display: flex; flex-wrap: wrap; gap: 24px; font-size: 16px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 24px;">⏱️</span>
                    <span><strong><?php echo $quiz['duration']; ?></strong> minutes</span>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 24px;">📝</span>
                    <span><strong><?php echo count($quiz['questions']); ?></strong> questions</span>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 24px;">✅</span>
                    <span><strong><?php echo $quiz['passing_score']; ?>%</strong> to pass</span>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 24px;">🏆</span>
                    <span>Earn <strong>Certificate</strong></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quiz Container -->
    <div style="max-width: 900px; margin: 0 auto;">
        <!-- Start Screen -->
        <div id="quiz-start-screen" style="
            background: white;
            padding: 60px 40px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        ">
            <div style="font-size: 80px; margin-bottom: 24px;">🎯</div>
            <h2 style="font-size: 32px; font-weight: 800; color: #1e293b; margin-bottom: 16px;">
                Ready to Test Your Skills?
            </h2>
            <p style="font-size: 16px; color: #64748b; margin-bottom: 32px; max-width: 500px; margin-left: auto; margin-right: auto;">
                This assessment will test your knowledge in <?php echo esc_html($quiz['title']); ?>.
                You'll have <?php echo $quiz['duration']; ?> minutes to complete <?php echo count($quiz['questions']); ?> questions.
                Score <?php echo $quiz['passing_score']; ?>% or higher to earn your certificate.
            </p>

            <div style="background: #f8fafc; padding: 24px; border-radius: 12px; margin-bottom: 32px;">
                <h3 style="font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 16px;">Instructions:</h3>
                <ul style="text-align: left; color: #64748b; line-height: 1.8; max-width: 500px; margin: 0 auto;">
                    <li>Read each question carefully</li>
                    <li>Select the best answer for each question</li>
                    <li>You cannot go back once you submit</li>
                    <li>Timer will start when you click "Start Test"</li>
                    <li>You can retake the test anytime</li>
                </ul>
            </div>

            <button id="start-quiz-btn" class="jobportal-btn jobportal-btn-primary" style="
                padding: 16px 48px;
                font-size: 18px;
                font-weight: 700;
            ">
                Start Test Now
            </button>
        </div>

        <!-- Quiz Questions (Hidden Initially) -->
        <div id="quiz-questions-container" style="display: none;">
            <!-- Timer and Progress -->
            <div style="
                background: white;
                padding: 20px 32px;
                border-radius: 16px;
                margin-bottom: 24px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            ">
                <div>
                    <span style="color: #64748b; font-size: 14px; font-weight: 600;">QUESTION</span>
                    <span id="current-question" style="font-size: 24px; font-weight: 800; color: #1e293b; margin: 0 8px;">1</span>
                    <span style="color: #64748b; font-size: 14px;">of <?php echo count($quiz['questions']); ?></span>
                </div>
                <div style="display: flex; align-items: center; gap: 12px;">
                    <span style="font-size: 24px;">⏱️</span>
                    <span id="quiz-timer" style="font-size: 24px; font-weight: 800; color: #00B4D8;">
                        <?php echo $quiz['duration']; ?>:00
                    </span>
                </div>
            </div>

            <!-- Progress Bar -->
            <div style="
                background: #e5e7eb;
                height: 8px;
                border-radius: 4px;
                margin-bottom: 32px;
                overflow: hidden;
            ">
                <div id="progress-bar" style="
                    height: 100%;
                    background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
                    width: 0%;
                    transition: width 0.3s ease;
                "></div>
            </div>

            <!-- Question Card -->
            <div id="question-card" style="
                background: white;
                padding: 48px 40px;
                border-radius: 20px;
                margin-bottom: 24px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                min-height: 400px;
            ">
                <!-- Question content loaded via JS -->
            </div>

            <!-- Navigation Buttons -->
            <div style="display: flex; justify-content: space-between; gap: 16px;">
                <button id="prev-question-btn" class="jobportal-btn" style="
                    background: #f8fafc;
                    color: #1e293b;
                    border: 2px solid #e2e8f0;
                    display: none;
                ">
                    ← Previous
                </button>
                <button id="next-question-btn" class="jobportal-btn jobportal-btn-primary" style="margin-left: auto;">
                    Next →
                </button>
                <button id="submit-quiz-btn" class="jobportal-btn jobportal-btn-primary" style="display: none;">
                    Submit Test
                </button>
            </div>
        </div>

        <!-- Results Screen (Hidden Initially) -->
        <div id="quiz-results" style="display: none;">
            <!-- Results loaded via JS -->
        </div>
    </div>
</div>

<!-- Quiz Data -->
<script>
window.quizData = <?php echo json_encode($quiz); ?>;
window.quizSkill = '<?php echo esc_js($skill); ?>';
</script>

<?php
get_footer();

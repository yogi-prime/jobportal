<?php
/**
 * Skills Assessment System
 * Interactive quizzes, certificates, and skill badges
 *
 * @package JobPortal
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Skills Assessment Quiz Data
 */
function jobportal_get_skill_quizzes() {
    return array(
        'javascript' => array(
            'title' => 'JavaScript Developer',
            'description' => 'Test your JavaScript knowledge',
            'duration' => 30, // minutes
            'passing_score' => 70,
            'questions' => array(
                array(
                    'question' => 'What is the output of: typeof null',
                    'options' => array('null', 'object', 'undefined', 'number'),
                    'correct' => 1,
                    'explanation' => 'typeof null returns "object" - this is a known JavaScript quirk.'
                ),
                array(
                    'question' => 'Which method is used to add elements to the end of an array?',
                    'options' => array('push()', 'pop()', 'shift()', 'unshift()'),
                    'correct' => 0,
                    'explanation' => 'push() adds elements to the end of an array.'
                ),
                array(
                    'question' => 'What does "use strict" do in JavaScript?',
                    'options' => array(
                        'Makes code run faster',
                        'Enables strict mode for better error checking',
                        'Minifies the code',
                        'Compiles code to machine language'
                    ),
                    'correct' => 1,
                    'explanation' => '"use strict" enables strict mode which catches common coding mistakes.'
                ),
                array(
                    'question' => 'What is a closure in JavaScript?',
                    'options' => array(
                        'A function with no parameters',
                        'A function that has access to its outer function scope',
                        'A function that returns nothing',
                        'A class method'
                    ),
                    'correct' => 1,
                    'explanation' => 'A closure is a function that retains access to its outer scope even after the outer function has returned.'
                ),
                array(
                    'question' => 'What is the difference between == and === in JavaScript?',
                    'options' => array(
                        'No difference',
                        '== checks value, === checks value and type',
                        '=== is faster',
                        '== is deprecated'
                    ),
                    'correct' => 1,
                    'explanation' => '== performs type coercion, while === checks both value and type without coercion.'
                ),
                array(
                    'question' => 'What is the output of: [1, 2, 3].map(x => x * 2)',
                    'options' => array('[1, 2, 3]', '[2, 4, 6]', '[1, 4, 9]', 'undefined'),
                    'correct' => 1,
                    'explanation' => 'map() creates a new array with each element multiplied by 2: [2, 4, 6].'
                ),
                array(
                    'question' => 'What does Promise.all() do?',
                    'options' => array(
                        'Creates a single promise',
                        'Waits for all promises to resolve or any to reject',
                        'Cancels all promises',
                        'Chains multiple promises'
                    ),
                    'correct' => 1,
                    'explanation' => 'Promise.all() waits for all promises to resolve, or rejects if any promise rejects.'
                ),
                array(
                    'question' => 'What is event bubbling?',
                    'options' => array(
                        'Events move from child to parent elements',
                        'Events move from parent to child elements',
                        'Events are duplicated',
                        'Events are cancelled'
                    ),
                    'correct' => 0,
                    'explanation' => 'Event bubbling means events propagate from the target element up to its ancestors.'
                ),
                array(
                    'question' => 'What is the purpose of async/await?',
                    'options' => array(
                        'To make code run synchronously',
                        'To handle asynchronous operations with cleaner syntax',
                        'To speed up code execution',
                        'To create threads'
                    ),
                    'correct' => 1,
                    'explanation' => 'async/await provides a more readable way to work with promises and asynchronous code.'
                ),
                array(
                    'question' => 'What does the spread operator (...) do?',
                    'options' => array(
                        'Deletes elements',
                        'Expands iterables into individual elements',
                        'Compresses arrays',
                        'Sorts elements'
                    ),
                    'correct' => 1,
                    'explanation' => 'The spread operator (...) expands an iterable (like an array) into individual elements.'
                ),
            ),
        ),
        'react' => array(
            'title' => 'React Developer',
            'description' => 'Test your React knowledge',
            'duration' => 30,
            'passing_score' => 70,
            'questions' => array(
                array(
                    'question' => 'What is JSX?',
                    'options' => array(
                        'A JavaScript framework',
                        'A syntax extension for JavaScript',
                        'A CSS preprocessor',
                        'A database query language'
                    ),
                    'correct' => 1,
                    'explanation' => 'JSX is a syntax extension that allows you to write HTML-like code in JavaScript.'
                ),
                array(
                    'question' => 'What is the purpose of useState hook?',
                    'options' => array(
                        'To fetch data',
                        'To manage component state',
                        'To handle routing',
                        'To optimize performance'
                    ),
                    'correct' => 1,
                    'explanation' => 'useState is a hook that allows functional components to have state.'
                ),
                array(
                    'question' => 'What is the Virtual DOM?',
                    'options' => array(
                        'A copy of the real DOM',
                        'An in-memory representation of the DOM',
                        'A browser API',
                        'A CSS framework'
                    ),
                    'correct' => 1,
                    'explanation' => 'Virtual DOM is a lightweight copy of the actual DOM that React uses for efficient updates.'
                ),
                array(
                    'question' => 'What does useEffect do?',
                    'options' => array(
                        'Manages state',
                        'Handles side effects in functional components',
                        'Creates components',
                        'Validates props'
                    ),
                    'correct' => 1,
                    'explanation' => 'useEffect performs side effects like data fetching, subscriptions, or DOM manipulation.'
                ),
                array(
                    'question' => 'What are React props?',
                    'options' => array(
                        'Component methods',
                        'Arguments passed to components',
                        'CSS properties',
                        'Event handlers'
                    ),
                    'correct' => 1,
                    'explanation' => 'Props are arguments passed into React components, similar to function parameters.'
                ),
                array(
                    'question' => 'What is the difference between props and state?',
                    'options' => array(
                        'No difference',
                        'Props are passed from parent, state is managed within component',
                        'State is faster',
                        'Props are deprecated'
                    ),
                    'correct' => 1,
                    'explanation' => 'Props are passed from parent components, while state is managed within the component.'
                ),
                array(
                    'question' => 'What is prop drilling?',
                    'options' => array(
                        'Optimizing props',
                        'Passing props through multiple component layers',
                        'Validating props',
                        'Deleting props'
                    ),
                    'correct' => 1,
                    'explanation' => 'Prop drilling is passing props through intermediate components that don\'t need them.'
                ),
                array(
                    'question' => 'What is React Context used for?',
                    'options' => array(
                        'Styling components',
                        'Sharing data globally without prop drilling',
                        'Routing',
                        'Testing'
                    ),
                    'correct' => 1,
                    'explanation' => 'Context provides a way to share values between components without passing props manually.'
                ),
                array(
                    'question' => 'What is the purpose of keys in React lists?',
                    'options' => array(
                        'For styling',
                        'To help React identify which items changed',
                        'For security',
                        'To sort items'
                    ),
                    'correct' => 1,
                    'explanation' => 'Keys help React identify which items have changed, been added, or removed for efficient updates.'
                ),
                array(
                    'question' => 'What is React.memo()?',
                    'options' => array(
                        'A state management tool',
                        'A performance optimization that prevents re-renders',
                        'A routing library',
                        'A testing utility'
                    ),
                    'correct' => 1,
                    'explanation' => 'React.memo() is a higher-order component that prevents unnecessary re-renders.'
                ),
            ),
        ),
        'python' => array(
            'title' => 'Python Developer',
            'description' => 'Test your Python programming skills',
            'duration' => 30,
            'passing_score' => 70,
            'questions' => array(
                array(
                    'question' => 'What is the output of: print(type([]))',
                    'options' => array('list', '<class \'list\'>', 'array', 'sequence'),
                    'correct' => 1,
                    'explanation' => 'type([]) returns <class \'list\'>.'
                ),
                array(
                    'question' => 'What is a list comprehension?',
                    'options' => array(
                        'A type of loop',
                        'A concise way to create lists',
                        'A function decorator',
                        'A class method'
                    ),
                    'correct' => 1,
                    'explanation' => 'List comprehensions provide a concise way to create lists: [x*2 for x in range(10)].'
                ),
                array(
                    'question' => 'What is the difference between a list and tuple?',
                    'options' => array(
                        'No difference',
                        'Lists are mutable, tuples are immutable',
                        'Tuples are faster for all operations',
                        'Lists can only store numbers'
                    ),
                    'correct' => 1,
                    'explanation' => 'Lists can be modified after creation (mutable), while tuples cannot (immutable).'
                ),
                array(
                    'question' => 'What does the "self" keyword represent in Python classes?',
                    'options' => array(
                        'The class name',
                        'The instance of the class',
                        'A global variable',
                        'The parent class'
                    ),
                    'correct' => 1,
                    'explanation' => '"self" represents the instance of the class and gives access to its attributes and methods.'
                ),
                array(
                    'question' => 'What is a decorator in Python?',
                    'options' => array(
                        'A design pattern',
                        'A function that modifies another function',
                        'A class attribute',
                        'A loop structure'
                    ),
                    'correct' => 1,
                    'explanation' => 'A decorator is a function that takes another function and extends its behavior.'
                ),
                array(
                    'question' => 'What does the "with" statement do?',
                    'options' => array(
                        'Creates a loop',
                        'Ensures proper resource management (like closing files)',
                        'Defines a function',
                        'Imports modules'
                    ),
                    'correct' => 1,
                    'explanation' => 'The "with" statement ensures resources are properly managed (e.g., files are closed).'
                ),
                array(
                    'question' => 'What is a lambda function?',
                    'options' => array(
                        'A named function',
                        'An anonymous inline function',
                        'A class method',
                        'A variable type'
                    ),
                    'correct' => 1,
                    'explanation' => 'Lambda functions are anonymous functions defined with the lambda keyword.'
                ),
                array(
                    'question' => 'What is the Global Interpreter Lock (GIL)?',
                    'options' => array(
                        'A security feature',
                        'A mutex that allows only one thread to execute Python code at a time',
                        'A compilation tool',
                        'A package manager'
                    ),
                    'correct' => 1,
                    'explanation' => 'The GIL is a mutex that prevents multiple threads from executing Python bytecode simultaneously.'
                ),
                array(
                    'question' => 'What does *args do in a function definition?',
                    'options' => array(
                        'Multiplies arguments',
                        'Allows passing variable number of positional arguments',
                        'Requires exactly one argument',
                        'Converts arguments to strings'
                    ),
                    'correct' => 1,
                    'explanation' => '*args allows a function to accept any number of positional arguments as a tuple.'
                ),
                array(
                    'question' => 'What is the difference between "is" and "=="?',
                    'options' => array(
                        'No difference',
                        '"is" checks identity, "==" checks equality',
                        '"is" is faster',
                        '"==" is deprecated'
                    ),
                    'correct' => 1,
                    'explanation' => '"is" checks if two variables point to the same object, "==" checks if values are equal.'
                ),
            ),
        ),
        'php' => array(
            'title' => 'PHP Developer',
            'description' => 'Test your PHP and WordPress knowledge',
            'duration' => 30,
            'passing_score' => 70,
            'questions' => array(
                array(
                    'question' => 'What does PHP stand for?',
                    'options' => array(
                        'Personal Home Page',
                        'PHP: Hypertext Preprocessor',
                        'Programming Hypertext Processor',
                        'Private HTML Pages'
                    ),
                    'correct' => 1,
                    'explanation' => 'PHP is a recursive acronym for "PHP: Hypertext Preprocessor".'
                ),
                array(
                    'question' => 'What is the correct way to start a PHP code block?',
                    'options' => array('&lt;php&gt;', '&lt;?php', '&lt;script&gt;', '&lt;%'),
                    'correct' => 1,
                    'explanation' => 'PHP code blocks start with &lt;?php and end with ?&gt;.'
                ),
                array(
                    'question' => 'What is the difference between "include" and "require"?',
                    'options' => array(
                        'No difference',
                        'require throws fatal error if file not found, include shows warning',
                        'include is faster',
                        'require is deprecated'
                    ),
                    'correct' => 1,
                    'explanation' => 'require produces a fatal error if file is not found, include only produces a warning.'
                ),
                array(
                    'question' => 'What does $_POST do in PHP?',
                    'options' => array(
                        'Sends email',
                        'Retrieves form data sent via POST method',
                        'Creates variables',
                        'Validates forms'
                    ),
                    'correct' => 1,
                    'explanation' => '$_POST is a superglobal array that collects form data sent via POST method.'
                ),
                array(
                    'question' => 'What is a WordPress hook?',
                    'options' => array(
                        'A security feature',
                        'A way to modify WordPress behavior at specific points',
                        'A database query',
                        'A page template'
                    ),
                    'correct' => 1,
                    'explanation' => 'Hooks allow you to "hook into" WordPress and change how it works without modifying core files.'
                ),
                array(
                    'question' => 'What is the difference between actions and filters in WordPress?',
                    'options' => array(
                        'No difference',
                        'Actions perform tasks, filters modify data',
                        'Filters are faster',
                        'Actions are deprecated'
                    ),
                    'correct' => 1,
                    'explanation' => 'Actions execute code at specific points, filters modify and return data.'
                ),
                array(
                    'question' => 'What does wp_enqueue_script() do?',
                    'options' => array(
                        'Deletes scripts',
                        'Properly loads JavaScript files',
                        'Minifies scripts',
                        'Validates scripts'
                    ),
                    'correct' => 1,
                    'explanation' => 'wp_enqueue_script() safely loads JavaScript files with dependency management.'
                ),
                array(
                    'question' => 'What is a WordPress Custom Post Type?',
                    'options' => array(
                        'A blog post',
                        'A content type beyond posts and pages',
                        'A page template',
                        'A user role'
                    ),
                    'correct' => 1,
                    'explanation' => 'Custom Post Types allow you to create content types beyond default posts and pages.'
                ),
                array(
                    'question' => 'What does sanitize_text_field() do?',
                    'options' => array(
                        'Formats text',
                        'Removes harmful code from user input',
                        'Translates text',
                        'Encrypts text'
                    ),
                    'correct' => 1,
                    'explanation' => 'sanitize_text_field() strips tags and removes unwanted characters for security.'
                ),
                array(
                    'question' => 'What is the WordPress Loop?',
                    'options' => array(
                        'A security check',
                        'PHP code that displays posts',
                        'A redirect function',
                        'A caching mechanism'
                    ),
                    'correct' => 1,
                    'explanation' => 'The WordPress Loop is PHP code used to display posts on a page.'
                ),
            ),
        ),
        'sql' => array(
            'title' => 'SQL & Database',
            'description' => 'Test your database and SQL knowledge',
            'duration' => 30,
            'passing_score' => 70,
            'questions' => array(
                array(
                    'question' => 'What does SQL stand for?',
                    'options' => array(
                        'Standard Query Language',
                        'Structured Query Language',
                        'Simple Question Language',
                        'System Query Language'
                    ),
                    'correct' => 1,
                    'explanation' => 'SQL stands for Structured Query Language.'
                ),
                array(
                    'question' => 'Which SQL statement is used to extract data?',
                    'options' => array('GET', 'SELECT', 'EXTRACT', 'PULL'),
                    'correct' => 1,
                    'explanation' => 'SELECT is used to retrieve data from a database.'
                ),
                array(
                    'question' => 'What is a PRIMARY KEY?',
                    'options' => array(
                        'The first column',
                        'A unique identifier for each record',
                        'A password',
                        'The most important column'
                    ),
                    'correct' => 1,
                    'explanation' => 'A PRIMARY KEY uniquely identifies each record in a table.'
                ),
                array(
                    'question' => 'What does INNER JOIN do?',
                    'options' => array(
                        'Combines all rows',
                        'Returns rows that have matching values in both tables',
                        'Deletes rows',
                        'Creates new tables'
                    ),
                    'correct' => 1,
                    'explanation' => 'INNER JOIN returns records that have matching values in both tables.'
                ),
                array(
                    'question' => 'What is normalization?',
                    'options' => array(
                        'Making data uppercase',
                        'Organizing data to reduce redundancy',
                        'Encrypting data',
                        'Backing up data'
                    ),
                    'correct' => 1,
                    'explanation' => 'Normalization organizes data to minimize redundancy and dependency.'
                ),
                array(
                    'question' => 'What does the WHERE clause do?',
                    'options' => array(
                        'Sorts results',
                        'Filters records based on conditions',
                        'Joins tables',
                        'Creates indexes'
                    ),
                    'correct' => 1,
                    'explanation' => 'WHERE filters records that meet specific conditions.'
                ),
                array(
                    'question' => 'What is an INDEX in SQL?',
                    'options' => array(
                        'A table column',
                        'A data structure that improves query speed',
                        'A backup',
                        'A user permission'
                    ),
                    'correct' => 1,
                    'explanation' => 'An INDEX is a data structure that speeds up data retrieval operations.'
                ),
                array(
                    'question' => 'What does the GROUP BY clause do?',
                    'options' => array(
                        'Deletes groups',
                        'Groups rows with same values into summary rows',
                        'Sorts alphabetically',
                        'Creates backups'
                    ),
                    'correct' => 1,
                    'explanation' => 'GROUP BY groups rows with same values and is often used with aggregate functions.'
                ),
                array(
                    'question' => 'What is a FOREIGN KEY?',
                    'options' => array(
                        'A backup key',
                        'A field that links to PRIMARY KEY in another table',
                        'An encryption key',
                        'A temporary key'
                    ),
                    'correct' => 1,
                    'explanation' => 'A FOREIGN KEY is a field that references the PRIMARY KEY of another table.'
                ),
                array(
                    'question' => 'What does the COUNT() function do?',
                    'options' => array(
                        'Adds numbers',
                        'Returns the number of rows',
                        'Multiplies values',
                        'Deletes rows'
                    ),
                    'correct' => 1,
                    'explanation' => 'COUNT() returns the number of rows that match a specified condition.'
                ),
            ),
        ),
    );
}

/**
 * Save Quiz Result
 */
function jobportal_save_quiz_result($user_id, $skill, $score, $total_questions, $time_taken) {
    $results = get_user_meta($user_id, '_jobportal_quiz_results', true) ?: array();

    $quiz_data = jobportal_get_skill_quizzes();
    $passing_score = $quiz_data[$skill]['passing_score'] ?? 70;
    $passed = ($score / $total_questions * 100) >= $passing_score;

    $result = array(
        'skill' => $skill,
        'score' => $score,
        'total' => $total_questions,
        'percentage' => round(($score / $total_questions) * 100, 2),
        'passed' => $passed,
        'time_taken' => $time_taken,
        'date' => current_time('mysql'),
        'certificate_id' => $passed ? uniqid('cert_') : null,
    );

    $results[] = $result;
    update_user_meta($user_id, '_jobportal_quiz_results', $results);

    // Update user skills if passed
    if ($passed) {
        $user_skills = get_user_meta($user_id, '_jobportal_verified_skills', true) ?: array();
        if (!in_array($skill, $user_skills)) {
            $user_skills[] = $skill;
            update_user_meta($user_id, '_jobportal_verified_skills', $user_skills);
        }
    }

    return $result;
}

/**
 * AJAX: Submit Quiz
 */
function jobportal_ajax_submit_quiz() {
    check_ajax_referer('jobportal_ajax_nonce', 'nonce');

    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'Please login to take quizzes'));
    }

    $user_id = get_current_user_id();
    $skill = sanitize_text_field($_POST['skill']);
    $answers = isset($_POST['answers']) ? $_POST['answers'] : array();
    $time_taken = intval($_POST['time_taken']);

    $quizzes = jobportal_get_skill_quizzes();

    if (!isset($quizzes[$skill])) {
        wp_send_json_error(array('message' => 'Invalid quiz'));
    }

    $quiz = $quizzes[$skill];
    $score = 0;
    $results = array();

    foreach ($quiz['questions'] as $index => $question) {
        $user_answer = isset($answers[$index]) ? intval($answers[$index]) : -1;
        $is_correct = $user_answer === $question['correct'];

        if ($is_correct) {
            $score++;
        }

        $results[] = array(
            'question' => $question['question'],
            'user_answer' => $user_answer,
            'correct_answer' => $question['correct'],
            'is_correct' => $is_correct,
            'explanation' => $question['explanation'],
        );
    }

    $result = jobportal_save_quiz_result($user_id, $skill, $score, count($quiz['questions']), $time_taken);

    wp_send_json_success(array(
        'score' => $score,
        'total' => count($quiz['questions']),
        'percentage' => $result['percentage'],
        'passed' => $result['passed'],
        'certificate_id' => $result['certificate_id'],
        'results' => $results,
    ));
}
add_action('wp_ajax_jobportal_submit_quiz', 'jobportal_ajax_submit_quiz');

/**
 * Get User's Verified Skills
 */
function jobportal_get_user_verified_skills($user_id) {
    return get_user_meta($user_id, '_jobportal_verified_skills', true) ?: array();
}

/**
 * Get User's Quiz History
 */
function jobportal_get_user_quiz_history($user_id) {
    return get_user_meta($user_id, '_jobportal_quiz_results', true) ?: array();
}

/**
 * Display Skill Badges
 */
function jobportal_display_skill_badges($user_id) {
    $skills = jobportal_get_user_verified_skills($user_id);

    if (empty($skills)) {
        return '<p style="color: #64748b;">No verified skills yet.</p>';
    }

    $skill_icons = array(
        'javascript' => '⚡',
        'react' => '⚛️',
        'python' => '🐍',
        'php' => '🐘',
        'sql' => '🗄️',
    );

    $html = '<div style="display: flex; flex-wrap: wrap; gap: 12px;">';

    foreach ($skills as $skill) {
        $icon = isset($skill_icons[$skill]) ? $skill_icons[$skill] : '✓';
        $skill_name = ucfirst($skill);

        $html .= '<div style="
            padding: 8px 16px;
            background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);
            color: white;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(79, 172, 254, 0.3);
        ">';
        $html .= '<span style="font-size: 18px;">' . $icon . '</span>';
        $html .= '<span>' . esc_html($skill_name) . '</span>';
        $html .= '<span style="
            background: rgba(255, 255, 255, 0.3);
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 11px;
        ">VERIFIED</span>';
        $html .= '</div>';
    }

    $html .= '</div>';

    return $html;
}

/**
 * Shortcode: Skills Test
 */
function jobportal_skills_test_shortcode($atts) {
    $atts = shortcode_atts(array(
        'skill' => 'javascript',
    ), $atts);

    if (!is_user_logged_in()) {
        return '<p style="padding: 20px; background: #fee2e2; color: #991b1b; border-radius: 12px;">Please <a href="' . wp_login_url() . '">login</a> to take skill tests.</p>';
    }

    $quizzes = jobportal_get_skill_quizzes();
    $skill = sanitize_text_field($atts['skill']);

    if (!isset($quizzes[$skill])) {
        return '<p>Invalid skill test.</p>';
    }

    $quiz = $quizzes[$skill];

    ob_start();
    ?>
    <div id="skills-test-container" data-skill="<?php echo esc_attr($skill); ?>">
        <!-- Quiz content loaded via JavaScript -->
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('skills_test', 'jobportal_skills_test_shortcode');

/**
 * Shortcode: User Skills Dashboard
 */
function jobportal_user_skills_dashboard_shortcode() {
    if (!is_user_logged_in()) {
        return '<p style="padding: 20px; background: #fee2e2; color: #991b1b; border-radius: 12px;">Please <a href="' . wp_login_url() . '">login</a> to view your skills.</p>';
    }

    $user_id = get_current_user_id();
    $verified_skills = jobportal_get_user_verified_skills($user_id);
    $quiz_history = jobportal_get_user_quiz_history($user_id);

    ob_start();
    ?>
    <div class="jobportal-skills-dashboard">
        <div style="margin-bottom: 40px;">
            <h2 style="font-size: 32px; font-weight: 800; color: #1e293b; margin-bottom: 16px;">
                Your Verified Skills
            </h2>
            <?php echo jobportal_display_skill_badges($user_id); ?>
        </div>

        <div style="margin-bottom: 40px;">
            <h3 style="font-size: 24px; font-weight: 700; color: #1e293b; margin-bottom: 20px;">
                Assessment History
            </h3>

            <?php if (empty($quiz_history)) : ?>
                <p style="color: #64748b;">No assessment history yet. Take a skill test to get started!</p>
            <?php else : ?>
                <div style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: linear-gradient(135deg, #00B4D8 0%, #00C896 100%);">
                                <th style="padding: 16px; text-align: left; color: white; font-weight: 700;">Skill</th>
                                <th style="padding: 16px; text-align: left; color: white; font-weight: 700;">Score</th>
                                <th style="padding: 16px; text-align: left; color: white; font-weight: 700;">Status</th>
                                <th style="padding: 16px; text-align: left; color: white; font-weight: 700;">Date</th>
                                <th style="padding: 16px; text-align: left; color: white; font-weight: 700;">Certificate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (array_reverse($quiz_history) as $result) : ?>
                                <tr style="border-bottom: 1px solid #e5e7eb;">
                                    <td style="padding: 16px; font-weight: 600; color: #1e293b;">
                                        <?php echo esc_html(ucfirst($result['skill'])); ?>
                                    </td>
                                    <td style="padding: 16px; color: #64748b;">
                                        <?php echo $result['score'] . '/' . $result['total']; ?>
                                        <span style="color: #10b981; font-weight: 600; margin-left: 8px;">
                                            (<?php echo $result['percentage']; ?>%)
                                        </span>
                                    </td>
                                    <td style="padding: 16px;">
                                        <?php if ($result['passed']) : ?>
                                            <span style="padding: 6px 12px; background: #d1fae5; color: #065f46; border-radius: 12px; font-size: 12px; font-weight: 700;">
                                                PASSED ✓
                                            </span>
                                        <?php else : ?>
                                            <span style="padding: 6px 12px; background: #fee2e2; color: #991b1b; border-radius: 12px; font-size: 12px; font-weight: 700;">
                                                FAILED ✗
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="padding: 16px; color: #64748b;">
                                        <?php echo date('M d, Y', strtotime($result['date'])); ?>
                                    </td>
                                    <td style="padding: 16px;">
                                        <?php if ($result['passed'] && $result['certificate_id']) : ?>
                                            <a href="<?php echo home_url('/certificate?id=' . $result['certificate_id']); ?>"
                                               style="color: #00B4D8; font-weight: 600; text-decoration: none;"
                                               target="_blank">
                                                View Certificate
                                            </a>
                                        <?php else : ?>
                                            <span style="color: #9ca3af;">-</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <div>
            <h3 style="font-size: 24px; font-weight: 700; color: #1e293b; margin-bottom: 20px;">
                Available Skill Tests
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px;">
                <?php
                $quizzes = jobportal_get_skill_quizzes();
                foreach ($quizzes as $skill_key => $quiz) :
                    $is_verified = in_array($skill_key, $verified_skills);
                ?>
                    <div style="background: white; padding: 24px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                        <h4 style="font-size: 20px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">
                            <?php echo esc_html($quiz['title']); ?>
                            <?php if ($is_verified) : ?>
                                <span style="color: #10b981; font-size: 14px;">✓</span>
                            <?php endif; ?>
                        </h4>
                        <p style="color: #64748b; margin-bottom: 16px; font-size: 14px;">
                            <?php echo esc_html($quiz['description']); ?>
                        </p>
                        <div style="display: flex; gap: 12px; margin-bottom: 16px; font-size: 13px; color: #64748b;">
                            <span>⏱️ <?php echo $quiz['duration']; ?> mins</span>
                            <span>📝 <?php echo count($quiz['questions']); ?> questions</span>
                            <span>✅ <?php echo $quiz['passing_score']; ?>% to pass</span>
                        </div>
                        <a href="<?php echo home_url('/skills-test?skill=' . $skill_key); ?>"
                           class="jobportal-btn jobportal-btn-primary"
                           style="display: inline-block; width: 100%; text-align: center; text-decoration: none;">
                            <?php echo $is_verified ? 'Retake Test' : 'Start Test'; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('user_skills_dashboard', 'jobportal_user_skills_dashboard_shortcode');

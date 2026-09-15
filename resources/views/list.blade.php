<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students | Hunnovate</title>
    <style>
        :root {
            color-scheme: light;
            --ink: #172033;
            --muted: #68738a;
            --line: #e7eaf0;
            --accent: #4f46e5;
            --accent-soft: #eef0ff;
            --page: #f7f8fc;
            --card: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 64px 24px;
            color: var(--ink);
            background: radial-gradient(circle at top right, #e9e9ff 0, transparent 34%), var(--page);
            font-family: Georgia, 'Times New Roman', serif;
        }

        .students-page {
            width: min(1120px, 100%);
            margin: 0 auto;
        }

        .page-heading {
            margin: 0 0 32px;
        }

        .page-heading p {
            margin: 0 0 10px;
            color: var(--accent);
            font: 700 0.75rem/1.2 Arial, sans-serif;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            font-size: clamp(2.2rem, 5vw, 4.5rem);
            font-weight: 400;
            letter-spacing: -0.04em;
            line-height: 0.98;
        }

        .student-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .student-card {
            position: relative;
            overflow: hidden;
            padding: 28px;
            border: 1px solid var(--line);
            border-radius: 18px;
            background: var(--card);
            box-shadow: 0 14px 35px rgba(35, 42, 70, 0.07);
            transition: transform 180ms ease, box-shadow 180ms ease;
        }

        .student-card::after {
            position: absolute;
            top: 0;
            right: 0;
            width: 76px;
            height: 76px;
            border-radius: 0 0 0 100%;
            background: var(--accent-soft);
            content: '';
        }

        .student-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 42px rgba(35, 42, 70, 0.12);
        }

        .student-avatar,
        .student-avatar-fallback {
            position: relative;
            z-index: 1;
            display: grid;
            width: 92px;
            height: 92px;
            margin-bottom: 22px;
            border: 5px solid #fff;
            border-radius: 50%;
            box-shadow: 0 8px 20px rgba(35, 42, 70, 0.16);
        }

        .student-avatar {
            object-fit: cover;
        }

        .student-avatar-fallback {
            place-items: center;
            color: #fff;
            background: linear-gradient(135deg, #4f46e5, #8b5cf6);
            font: 700 1.45rem/1 Arial, sans-serif;
        }

        .student-name {
            margin: 0 0 6px;
            font-size: 1.6rem;
            font-weight: 400;
            line-height: 1.1;
        }

        .student-gender {
            margin: 0 0 24px;
            color: var(--muted);
            font: 0.78rem/1.2 Arial, sans-serif;
            text-transform: capitalize;
        }

        .student-details {
            display: grid;
            gap: 12px;
            padding-top: 18px;
            border-top: 1px solid var(--line);
        }

        .detail-label {
            display: block;
            margin-bottom: 3px;
            color: var(--muted);
            font: 0.67rem/1.2 Arial, sans-serif;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .detail-value {
            font-size: 1rem;
        }

        @media (max-width: 540px) {
            body {
                padding: 40px 16px;
            }

            .student-card {
                padding: 24px;
            }
        }
    </style>
</head>

<body>
    <main class="students-page">
        <header class="page-heading">
            <p>Hunnovate community</p>
            <h1>Our students</h1>
        </header>

        <ul class="student-grid">
            @foreach ($studentList as $student)
                <x-student-card-item :initials="$student['initials']" :name="$student['name']" :gender="$student['gender']" :course="$student['course']"
                    :duration="$student['duration']" />
            @endforeach

        </ul>
    </main>
</body>

</html>

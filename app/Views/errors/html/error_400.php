<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bad Request - <?= lang('Errors.badRequest') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #fdfbfb, #ebedee);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 8vh auto;
            padding: 2rem;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 {
            font-size: 4rem;
            margin: 0;
            color: #dd4814;
        }
        h2 {
            font-size: 1.5rem;
            margin-top: 1rem;
            color: #444;
        }
        p {
            font-size: 1rem;
            margin-top: 1rem;
            color: #666;
        }
        .btn {
            display: inline-block;
            margin-top: 2rem;
            padding: 0.75rem 1.5rem;
            background-color: #dd4814;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background-color: #c43d0f;
        }
        .logo {
            opacity: 0.05;
            position: absolute;
            top: 2rem;
            left: 50%;
            transform: translateX(-50%);
            height: 150px;
            width: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>400</h1>
        <h2>Bad Request</h2>
        <p>
            <?php if (ENVIRONMENT !== 'production') : ?>
                <?= nl2br(esc($message)) ?>
            <?php else : ?>
                <?= lang('Errors.sorryBadRequest') ?>
            <?php endif; ?>
        </p>
        <p><b>It looks like something went wrong with your request. The page you're trying to access may be malformed or missing required data.</b></p>
        <a href="<?= base_url(); ?>" class="btn">Return to Homepage</a>
    </div>
</body>
</html>

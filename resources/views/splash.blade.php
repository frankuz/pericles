<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROMCE - Fundación Alquería Cavelier</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            width: 100%;
            height: 100%;
            overflow: hidden;
			font-family: "Poppins", sans-serif;
			line-height: 1;

        }

        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('images/fondo_promce.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: 1;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.6) 86%);
            z-index: 2;
        }

        .content {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 33.33%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 3;
            padding: 20px;
        }

        .text-line-1 {         
			    color: hsl(0, 75%, 50%);
            text-align: center;
            font-size: clamp(2rem, 15vw, 5rem);
            margin-bottom: 10px;
			font-weight: 900;
        }

        .text-line-2 {
			color: white;
            text-align: center;
            font-size: clamp(1.4rem, 6vw, 2rem);
			font-weight: 600;

        }


    </style>
</head>
<body>
    <div class="background"></div>
    <div class="overlay"></div>
    <div class="content">
        <div class="text-line-1">PROMCE</div>
        <div class="text-line-2">Fundación Alquería Cavelier</div>
    </div>
</body>
</html>
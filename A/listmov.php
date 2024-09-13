<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top 10 on IMDb this week</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #111;
            color: #fff;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            overflow: hidden;
        }

        h1 {
            text-align: center;
        }

        .movie-list {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
        }

        .movie {
            flex: 0 0 auto;
            width: 200px;
            margin-right: 20px;
            background-color: #333;
            border-radius: 10px;
            overflow: hidden;
        }

        .movie img {
            width: 100%;
            height: auto;
        }

        .movie-info {
            padding: 10px;
        }

        .movie-info h2 {
            font-size: 1.1em;
            margin: 0;
        }

        .movie-info p {
            margin: 5px 0;
        }

        .movie-info .rating {
            display: flex;
            align-items: center;
        }

        .movie-info .rating span {
            margin-left: 5px;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .buttons button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        .buttons button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Top 10 on IMDb this week</h1>
        <div class="buttons">
            <button id="prev">❮ Prev</button>
            <button id="next">Next ❯</button>
        </div>
        <div class="movie-list" id="movieList">
            <div class="movie">
                <img src="https://via.placeholder.com/200x300" alt="House of the Dragon">
                <div class="movie-info">
                    <h2>House of the Dragon</h2>
                    <div class="rating">
                        <span>⭐</span>
                        <span>8.4</span>
                    </div>
                    <p>June 16, Max</p>
                    <button>Trailer</button>
                </div>
            </div>
            <div class="movie">
                <img src="https://via.placeholder.com/200x300" alt="The Boys">
                <div class="movie-info">
                    <h2>The Boys</h2>
                    <div class="rating">
                        <span>⭐</span>
                        <span>8.7</span>
                    </div>
                    <p>June 13, Prime</p>
                    <button>Trailer</button>
                </div>
            </div>
            <div class="movie">
                <img src="https://via.placeholder.com/200x300" alt="Gladiator II">
                <div class="movie-info">
                    <h2>Gladiator II</h2>
                    <div class="rating">
                        <span>⭐</span>
                    </div>
                    <p>November 22</p>
                    <button>Trailer</button>
                </div>
            </div>
            <div class="movie">
                <img src="https://via.placeholder.com/200x300" alt="Longlegs">
                <div class="movie-info">
                    <h2>Longlegs</h2>
                    <div class="rating">
                        <span>⭐</span>
                        <span>7.3</span>
                    </div>
                    <p>R</p>
                    <button>Trailer</button>
                </div>
            </div>
            <div class="movie">
                <img src="https://via.placeholder.com/200x300" alt="Beverly Hills Cop: Axel F">
                <div class="movie-info">
                    <h2>Beverly Hills Cop: Axel F</h2>
                    <div class="rating">
                        <span>⭐</span>
                        <span>6.5</span>
                    </div>
                    <p>July 3, Netflix</p>
                    <button>Trailer</button>
                </div>
            </div>
            <div class="movie">
                <img src="https://via.placeholder.com/200x300" alt="The Bear">
                <div class="movie-info">
                    <h2>The Bear</h2>
                    <div class="rating">
                        <span>⭐</span>
                        <span>8.6</span>
                    </div>
                    <p>June 27, Hulu</p>
                    <button>Trailer</button>
                </div>
            </div>
            <div class="movie">
                <img src="https://via.placeholder.com/200x300" alt="The Boys">
                <div class="movie-info">
                    <h2>The Boys</h2>
                    <div class="rating">
                        <span>⭐</span>
                        <span>8.7</span>
                    </div>
                    <p>June 13, Prime</p>
                    <button>Trailer</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const movieList = document.getElementById('movieList');
        const prevButton = document.getElementById('prev');
        const nextButton = document.getElementById('next');

        prevButton.addEventListener('click', () => {
            movieList.scrollBy({
                left: -200,
                behavior: 'smooth'
            });
        });

        nextButton.addEventListener('click', () => {
            movieList.scrollBy({
                left: 200,
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html>

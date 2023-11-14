    <script>
        function clearSession() {
            var xhr = new XMLHttpRequest();

            xhr.open("GET", "exec/clear_session.php", true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log("Session cleared successfully.");
                }
            };

            xhr.send();
        }
    </script>
    <script src="./js/jquery.min.js"></script>
	<script src="./js/bootstrap.min.js" crossorigin="anonymous"></script>
	<script src="./js/feather.min.js"></script>
	<script src="./js/Chart.min.js"></script>
	<script src="./js/dashboard.js"></script>
 </body>
</html>
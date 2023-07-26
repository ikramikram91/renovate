<?php
$connect = new PDO("mysql:host=localhost;dbname=comment_plumber", "root", "");

if(isset($_POST["rating_data"]))
{

	$data = array(
		':user_name'		=>	$_POST["user_name"],
		':user_rating'		=>	$_POST["rating_data"],
		':user_review'		=>	$_POST["user_review"],
		':datetime'			=>	time()
	);
// insertion des donnée dans la bdd
	$query = "
	INSERT INTO comment
	(user_name, user_review, rating_data,  create_date) 
	VALUES (:user_name, :user_review,:user_rating,  :datetime)
	";

	$statement = $connect->prepare($query);

	$statement->execute($data);

	echo "Votre commentaire à bien étais poster";

}
if(isset($_POST["action"]))
{
	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;
	$review_content = array();

	$query = "
	SELECT * FROM comment
	ORDER BY id DESC
	";

	$result = $connect->query($query, PDO::FETCH_ASSOC);

	foreach($result as $row)
	{
		$review_content[] = array(
			'user_name'		=>	$row["user_name"],
			'user_review'	=>	$row["user_review"],
			'rating'		=>	$row["rating_data"],
			'datetime'		=>	date('d m Y h:i:s', $row["create_date"])
		);

		if($row["rating_data"] == '5')
		{
			$five_star_review++;
		}

		if($row["rating_data"] == '4')
		{
			$four_star_review++;
		}

		if($row["rating_data"] == '3')
		{
			$three_star_review++;
		}

		if($row["rating_data"] == '2')
		{
			$two_star_review++;
		}

		if($row["rating_data"] == '1')
		{
			$one_star_review++;
		}

		$total_review++;

		$total_user_rating = $total_user_rating + $row["rating_data"];

	}

	$average_rating = $total_user_rating / $total_review;

	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content
	);

	echo json_encode($output);

}

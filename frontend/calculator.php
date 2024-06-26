<?php
function calculate_dating_pool($data) {
  global $wpdb;

  // Define table names (replace with your actual prefixes if different)
  $demographics_table = 'demographics';
  $nhis_table = 'nhis';

  // Extract user preferences from form data
  $age_min = $data['age_range'][0];
  $age_max = $data['age_range'][1];
  $min_income = $data['income_slider'];
  $race = $data['race'];
  $gender_preference = $data['gender_preference']; // Male or Female (optional)
  $exclude_obese = isset($data['exclude_obese']) ? $data['exclude_obese'] : false; // Optional checkbox
  $height_feet = $data['height_feet'];
  $height_inches = $data['height_inches'];

  // Build the base query
  $sql = "SELECT * 
          FROM $nhis_table";

  // Apply filters based on user preferences
  $where_clauses = [];

  $where_clauses[] = "nhis.Age BETWEEN $age_min AND $age_max";
  $where_clauses[] = "nhis.Income >= $min_income";
  $where_clauses[] = "nhis.height_feet >= $height_feet";
  $where_clauses[] = "nhis.height_inches >= $height_inches";
  $where_clauses[] = "nhis.Race = '$race'";


  // Optional gender preference filter
  if ($gender_preference) {
    $where_clauses[] = "nhis.Gender = '$gender_preference'";
  }

  // Optional filter to exclude obese individuals
  if ($exclude_obese) {
    $where_clauses[] = "nhis.isObese = 'No'";
  }

  // Combine where clauses with AND operator
  $where_clause = implode(' AND ', $where_clauses);

  // Add WHERE clause to the base query
  if ($where_clause) {
    $sql .= ' WHERE ' . $where_clause;
  }

  // Execute the prepared SQL statement
  $prepared_sql = $wpdb->prepare($sql);
  $filtered_results = $wpdb->get_results($prepared_sql);

  // Calculate total initial pool size (assuming data from demographics table)
  $initial_pool_size = $wpdb->get_var("SELECT COUNT(*) FROM $demographics_table");

  // Calculate dating pool size based on filtered results
  $dating_pool_size = count($filtered_results);

  // Calculate percentage of initial pool
  $percentage_of_dating_pool = ($dating_pool_size / $initial_pool_size) * 100;
  $rounded_percentage = round($percentage_of_dating_pool, 2);

  // Prepare results for display or further processing
  $results = [
    'dating_pool_size' => $dating_pool_size,
    'percentage' => $rounded_percentage,
    'sql' => $prepared_sql,
    'input' => $data
  ];

  return $results;
}



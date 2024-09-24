<?php

namespace App\Outputs;

use App\Outputs\ProfileFormatter;

class HTMLFormat implements ProfileFormatter
{
    private $response;

    public function setData($profile)
    {
        // Start the HTML structure
        $output = "<html><head><title>Profile of " . $profile->getFullName() . "</title></head><body>";
        $output .= "<h1>Profile of " . $profile->getFullName() . "</h1>";

        // Contact Information
        $output .= "<p><strong>Email:</strong> " . $profile->getContactDetails()['email'] . "</p>";
        $output .= "<p><strong>Phone:</strong> " . $profile->getContactDetails()['phone_number'] . "</p>";

        // Address
        $address = implode(", ", $profile->getContactDetails()['address']);
        $output .= "<p><strong>Address:</strong> " . $address . "</p>";

        // Education
        $output .= "<p><strong>Education:</strong> " . $profile->getEducation()['degree'] . " at " . $profile->getEducation()['university'] . "</p>";

        // Skills
        $output .= "<h2>Skills</h2><ul>";
        foreach ($profile->getSkills() as $skill) {
            $output .= "<li>" . $skill . "</li>";
        }
        $output .= "</ul>";

        // Experience
        $output .= "<h2>Experience</h2><ul>";
        foreach ($profile->getExperience() as $job) {
            $output .= "<li>" . $job['job_title'] . " at " . $job['company'] . " (" . $job['start_date'] . " to " . $job['end_date'] . ")</li>";
        }
        $output .= "</ul>";

        // Certifications
        $output .= "<h2>Certifications</h2><ul>";
        foreach ($profile->getCertifications() as $cert) {
            $output .= "<li>" . $cert['name'] . " (" . $cert['date_earned'] . ")</li>";
        }
        $output .= "</ul>";

        // Extra-Curricular Activities
        $output .= "<h2>Extra-Curricular Activities</h2><ul>";
        foreach ($profile->getExtracurricularActivities() as $extra) {
            $output .= "<li><strong>Role:</strong> " . $extra['role'] . " at " . $extra['organization'] . " (" . $extra['start_date'] . " to " . $extra['end_date'] . ")<br>";
            $output .= "<strong>Description:</strong> " . $extra['description'] . "</li>";
        }
        $output .= "</ul>";

        // Languages
        $output .= "<h2>Languages</h2><ul>";
        foreach ($profile->getLanguages() as $lang) {
            $output .= "<li>" . $lang['language'] . " (" . $lang['proficiency'] . ")</li>";
        }
        $output .= "</ul>";

        // References
        $output .= "<h2>References</h2><ul>";
        foreach ($profile->getReferences() as $ref) {
            $output .= "<li><strong>Name:</strong> " . $ref['name'] . "<br>";
            $output .= "<strong>Position:</strong> " . $ref['position'] . "<br>";
            $output .= "<strong>Company:</strong> " . $ref['company'] . "<br>";
            $output .= "<strong>Email:</strong> " . $ref['email'] . "<br>";
            $output .= "<strong>Phone:</strong> " . $ref['phone_number'] . "</li>";
        }
        $output .= "</ul>";

        // Close HTML structure
        $output .= "</body></html>";

        $this->response = $output;
    }

    public function render()
    {
        header('Content-Type: text/html');
        return $this->response;
    }
}

<?php
session_start(); // Start the session
$servername = "sql105.infinityfree.com";
$username = "if0_35273413";
$password = "uBNMpIV1LS";
$dbname = "if0_35273413_durga";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_SESSION['name']; // Retrieve the name from the session variable

// Get the sdrn value for the user
$sql = "SELECT sdrn FROM users WHERE name = '$name'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$sdrn = $row['sdrn'];

// Logout button
if(isset($_POST['logout'])) {
	session_unset();
	session_destroy();
	header("Location: index.php");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
	
</head>
<body>
	<div class="container">
		<div class="header">
			<div class="profile">
				<img src="xyz.jpeg" alt="Profile photo">
				<span>Welcome, <?php echo $name; ?></span>
			</div>
			<!-- Logout button -->
			<form class="logout-form" method="post">
				<input type="submit" name="logout" value="Logout">
			</form>
		</div>
		<div class="nav">
			<a href="Researchpaper.php">Research Project</a>
			<a href="patentform.php">Patents</a>
			<a href="Journal.php"> Journal Publications</a>
			<a href="Conference.php"> Conference Paper </a>
			<a href="Book.php"> Book </a>
			<a href="BookChapter.php"> Book Chapter </a>
			<a href="copyright.php"> Copyrights </a>

		</div>
		<div class="content">
    <h2>My Contributions - Research Papers</h2>
    <?php
$sdrn = $sdrn;

// Execute a SELECT query to retrieve the user's research paper contributions
$sql = "SELECT * FROM papers WHERE sdrn = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $sdrn);
$stmt->execute();
$result = $stmt->get_result();

// Display the user's contributions in a table
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<thead><tr><th>Title</th><th>Abstract</th><th>Area</th><th>Action</th><th>Action</th></tr></thead>";
    echo "<tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['abstract'] . "</td>";
        echo "<td>" . $row['area'] . "</td>";
        echo '<td><a href="Researchpaperupdate.php?id=' . $row['id'] . '" target="_blank">Modify</a></td>';
        echo '<td><a href="?action=delete&id=' . $row['id'] . '">Delete</a></td>';
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p>No contributions found.</p>";
}

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $deleteId = $_GET['id'];

    // Retrieve the file name associated with the record
    $getFileNameSql = "SELECT file FROM papers WHERE id = ?";
    $getFileNameStmt = $conn->prepare($getFileNameSql);
    $getFileNameStmt->bind_param("i", $deleteId);
    $getFileNameStmt->execute();
    $fileNameResult = $getFileNameStmt->get_result();

    if ($fileNameRow = mysqli_fetch_assoc($fileNameResult)) {
        $fileToDelete = $fileNameRow['file'];

        // Delete the file from the folder
        if (unlink("papers/" . $fileToDelete)) {
            // File deleted successfully, now delete the record from the database
            $deleteSql = "DELETE FROM papers WHERE id = ?";
            $deleteStmt = $conn->prepare($deleteSql);
            $deleteStmt->bind_param("i", $deleteId);

            if ($deleteStmt->execute()) {
                header("Location: dashboard.php");
            } else {
                echo "Error deleting record: " . $deleteStmt->error;
            }
        } else {
            echo "Error deleting file.";
        }
    } else {
        echo "File not found.";
    }
}
?>


<hr style="border-color: #333;">
<hr style="border-color: #333;">

<h2>My Contributions - Patents</h2>
<?php
$sdrn = $sdrn;

// Execute a SELECT query to retrieve the user's contributions
$sql = "SELECT * FROM patents WHERE sdrn = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $sdrn);
$stmt->execute();
$result = $stmt->get_result();

// Display the user's contributions in a table
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<thead><tr><th>Patent Title</th><th>Application No</th><th>Filing Date</th><th>Status</th><th>Action</th></tr></thead>";
    echo "<tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['patent_title'] . "</td>";
        echo "<td>" . $row['app_no'] . "</td>";
        echo "<td>" . $row['filing_date'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        
        // Modify this line to include 'id' in the query string when redirecting
        echo '<td><a href="patentupdate.php?id=' . $row['id'] . '" target="_blank">Modify</a> | <a href="?action=delete&app_no=' . $row['app_no'] . '">Delete</a></td>';
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p>No contributions found.</p>";
}

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['app_no'])) {
    $deleteAppNo = $_GET['app_no'];

    // Retrieve the file name associated with the record
    $getFileNameSql = "SELECT file FROM patents WHERE app_no = ?";
    $getFileNameStmt = $conn->prepare($getFileNameSql);
    $getFileNameStmt->bind_param("s", $deleteAppNo);
    $getFileNameStmt->execute();
    $fileNameResult = $getFileNameStmt->get_result();

    if ($fileNameRow = mysqli_fetch_assoc($fileNameResult)) {
        $fileToDelete = $fileNameRow['file'];

        // Delete the file from the folder
        if (unlink("Patents/" . $fileToDelete)) {
            // File deleted successfully, now delete the record from the database
            $deleteSql = "DELETE FROM patents WHERE app_no = ?";
            $deleteStmt = $conn->prepare($deleteSql);
            $deleteStmt->bind_param("s", $deleteAppNo);

            if ($deleteStmt->execute()) {
                // Record deleted successfully
                header("Location: dashboard.php");
            } else {
                echo "Error deleting record: " . $deleteStmt->error;
            }
        } else {
            echo "Error deleting file.";
        }
    } else {
        echo "File not found.";
    }
}
?>


<hr style="border-color: #333;">
<hr style="border-color: #333;">

<h2>My Contributions - Journal Papers</h2>
<?php
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['issn'])) {
    $deleteIssn = $_GET['issn'];

    // Retrieve the file name associated with the record
    $getFileNameSql = "SELECT file FROM journals WHERE issn = ?";
    $getFileNameStmt = $conn->prepare($getFileNameSql);
    $getFileNameStmt->bind_param("s", $deleteIssn);
    $getFileNameStmt->execute();
    $fileNameResult = $getFileNameStmt->get_result();

    if ($fileNameRow = mysqli_fetch_assoc($fileNameResult)) {
        $fileToDelete = $fileNameRow['file'];

        // Delete the file from the folder
        if (unlink("Journals/" . $fileToDelete)) {
            // File deleted successfully, now delete the record from the database
            $deleteSql = "DELETE FROM journals WHERE issn = ?";
            $deleteStmt = $conn->prepare($deleteSql);
            $deleteStmt->bind_param("s", $deleteIssn);

            if ($deleteStmt->execute()) {
                // Record deleted successfully
                header("Location: dashboard.php");
            } else {
                echo "Error deleting record: " . $deleteStmt->error;
            }
        } else {
            echo "Error deleting file.";
        }
    } else {
        echo "File not found.";
    }
}

$sdrn = $sdrn;

// Execute a SELECT query to retrieve the user's contributions
$sql = "SELECT * FROM journals WHERE sdrn = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $sdrn);
$stmt->execute();
$result = $stmt->get_result();

// Display the user's contributions in a table
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<thead><tr><th>Title</th><th>Authors</th><th>Department</th><th>Journal</th><th>Publication Date</th><th>ISSN</th><th>DOI</th><th>Action</th></tr></thead>";
    echo "<tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['authors'] . "</td>";
        echo "<td>" . $row['department'] . "</td>";
        echo "<td>" . $row['journal'] . "</td>";
        echo "<td>" . $row['pub_date'] . "</td>";
        echo "<td>" . $row['issn'] . "</td>";
        $row['doi'];

        if (!preg_match('/^https?:\/\//', $row['doi'])) {
            $row['doi'] = 'https://' . $row['doi'];
        }

        echo "<td><a href='" . $row['doi'] . "' target='_blank'>Link</a></td>";
        
        // Modify this line to include 'id' in the query string when redirecting
        echo '<td><a href="journalupdate.php?id=' . $row['id'] . '" target="_blank">Modify</a> | <a href="?action=delete&issn=' . $row['issn'] . '">Delete</a></td>';
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p>No contributions found.</p>";
}
?>


<hr style="border-color: #333;">
<hr style="border-color: #333;">

<h2>My Contributions - Conferences</h2>
<?php
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['topic'])) {
    $topicToDelete = $_GET['topic'];

    // Retrieve the file name associated with the record
    $getFileNameSql = "SELECT file FROM conference WHERE topic = ?";
    $getFileNameStmt = $conn->prepare($getFileNameSql);
    $getFileNameStmt->bind_param("s", $topicToDelete);
    $getFileNameStmt->execute();
    $fileNameResult = $getFileNameStmt->get_result();

    if ($fileNameRow = mysqli_fetch_assoc($fileNameResult)) {
        $fileToDelete = $fileNameRow['file'];

        // Delete the file from the folder
        if (unlink("conference/" . $fileToDelete)) {
            // File deleted successfully, now delete the record from the database
            $deleteSql = "DELETE FROM conference WHERE topic = ?";
            $deleteStmt = $conn->prepare($deleteSql);
            $deleteStmt->bind_param("s", $topicToDelete);

            if ($deleteStmt->execute()) {
                // Record deleted successfully
                header("Location: dashboard.php");
            } else {
                echo "Error deleting record: " . $deleteStmt->error;
            }
        } else {
            echo "Error deleting file.";
        }
    } else {
        echo "File not found.";
    }
}

// Define the user whose contributions you want to display
$sdrn = $sdrn;

// Execute a SELECT query to retrieve the user's contributions
$sql = "SELECT * FROM conference WHERE sdrn = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $sdrn);
$stmt->execute();
$result = $stmt->get_result();

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<thead><tr><th>Topic</th><th>Indexing</th><th>URL</th><th>Date</th><th>ISSN</th><th>DOI</th><th>Actions</th></tr></thead>";
    echo "<tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['topic'] . "</td>";
        echo "<td>" . $row['indexing'] . "</td>";
        echo "<td><a href='" . $row['url'] . "' target='_blank'>Link</a></td>";
        echo "<td>" . $row['pub_date'] . "</td>";
        echo "<td>" . $row['issn'] . "</td>";

        if (!preg_match('/^https?:\/\//', $row['doi'])) {
            $row['doi'] = 'https://' . $row['doi'];
        }

        echo "<td><a href='" . $row['doi'] . "' target='_blank'>Link</a></td>";
        
        echo '<td><a href="conferenceupdate.php?id=' . $row['id'] . '" target="_blank">Modify</a> | <a href="?action=delete&topic=' . $row['topic'] . '">Delete</a></td>';
        
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p>No contributions found.</p>";
}
?>








<hr style="border-color: #333;">
<hr style="border-color: #333;">

<h2>My Contributions - Book</h2>
<?php
// Assuming you have established the database connection ($conn) earlier in the code

// Define the user whose contributions you want to display
$sdrn = isset($sdrn) ? intval($sdrn) : 0;

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['issn_no'])) {
    $deleteIssnNo = $_GET['issn_no'];

    // Retrieve the file name associated with the record
    $getFileNameSql = "SELECT file FROM books WHERE issn_no = ?";
    $getFileNameStmt = $conn->prepare($getFileNameSql);
    $getFileNameStmt->bind_param("i", $deleteIssnNo);
    $getFileNameStmt->execute();
    $fileNameResult = $getFileNameStmt->get_result();

    if ($fileNameRow = mysqli_fetch_assoc($fileNameResult)) {
        $fileToDelete = $fileNameRow['file'];

        // Delete the file from the folder
        if (unlink("Books/" . $fileToDelete)) {
            // File deleted successfully, now delete the record from the database
            $deleteSql = "DELETE FROM books WHERE issn_no = ?";
            $deleteStmt = $conn->prepare($deleteSql);
            $deleteStmt->bind_param("i", $deleteIssnNo);

            if ($deleteStmt->execute()) {
                // Record deleted successfully
                header("Location: dashboard.php");
            } else {
                echo "Error deleting record: " . $deleteStmt->error;
            }
        } else {
            echo "Error deleting file.";
        }
    } else {
        echo "File not found.";
    }
}

// Execute a SELECT query to retrieve the user's contributions
$sql = "SELECT * FROM books WHERE sdrn_no = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $sdrn);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    echo "Error executing the query: " . mysqli_error($conn);
} else {
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<thead><tr><th>Topic</th><th>Publisher</th><th>Book Type</th><th>Indexing</th><th>ISSN No</th><th>Publishing Date</th><th>Web Link</th><th>Department</th><th>File</th><th>Action</th><th>Action</th></tr></thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['topic'] . "</td>";
            echo "<td>" . $row['publisher'] . "</td>";
            echo "<td>" . $row['book_type'] . "</td>";
            echo "<td>" . $row['indexing'] . "</td>";
            echo "<td>" . $row['issn_no'] . "</td>";
            echo "<td>" . $row['pub_date'] . "</td>";
            echo "<td><a href='" . $row['weblink'] . "' target='_blank'>Link</a></td>";
            echo "<td>" . $row['department'] . "</td>";
            echo "<td><a href='Books/" . $row['file'] . "' target='_blank'>Download</a></td>";
            echo '<td><a href="BookUpdate.php?id=' . $row['id'] . '" target="_blank">Modify</a></td>';
            echo '<td><a href="?action=delete&issn_no=' . $row['issn_no'] . '">Delete</a></td>';
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No contributions found.</p>";
    }
}
?>



<hr style="border-color: #333;">
<hr style="border-color: #333;">

<h2>My Contributions - Book Chapter</h2>
<?php
// Define the user whose contributions you want to display
$sdrn = $sdrn;

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['isbn'])) {
    $deleteIsbn = $_GET['isbn'];

    // Retrieve the file name associated with the record
    $getFileNameSql = "SELECT file FROM book_chapters WHERE isbn = ?";
    $getFileNameStmt = $conn->prepare($getFileNameSql);
    $getFileNameStmt->bind_param("s", $deleteIsbn);
    $getFileNameStmt->execute();
    $fileNameResult = $getFileNameStmt->get_result();

    if ($fileNameRow = mysqli_fetch_assoc($fileNameResult)) {
        $fileToDelete = $fileNameRow['file'];

        // Delete the file from the folder
        if (unlink("book_chapters/" . $fileToDelete)) {
            // File deleted successfully, now delete the record from the database
            $deleteSql = "DELETE FROM book_chapters WHERE isbn = ?";
            $deleteStmt = $conn->prepare($deleteSql);
            $deleteStmt->bind_param("s", $deleteIsbn);

            if ($deleteStmt->execute()) {
                // Record deleted successfully
                header("Location: dashboard.php");
            } else {
                echo "Error deleting record: " . $deleteStmt->error;
            }
        } else {
            echo "Error deleting file.";
        }
    } else {
        echo "File not found.";
    }
}

// Execute a SELECT query to retrieve the user's contributions
$sql = "SELECT * FROM book_chapters WHERE sdrn_no = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $sdrn);
$stmt->execute();
$result = $stmt->get_result();

// Display the user's contributions in a table
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<thead><tr><th>Name of the Book</th><th>Chapter Title</th><th>DOI</th><th>ISBN</th><th>Modify</th><th>Delete</th></tr></thead>";
    echo "<tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['book'] . "</td>";
        echo "<td>" . $row['chapter_name'] . "</td>";
        echo "<td><a href='" . $row['doi'] . "' target='_blank'>Link</a></td>";
        echo "<td>" . $row['isbn'] . "</td>";
        echo '<td><a href="BookChapterupdate.php?id=' . $row['id'] . '" target="_blank">Modify</a></td>';
        echo '<td><a href="?action=delete&isbn=' . $row['isbn'] . '">Delete</a></td>';
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p>No contributions found.</p>";
}
?>

<hr style="border-color: #333;">
<hr style="border-color: #333;">


<h2>My Contributions - Copyright</h2>
<?php
// Define the user whose contributions you want to display
$sdrn = isset($sdrn) ? intval($sdrn) : 0;

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['title'])) {
    $deleteTitle = $_GET['title'];

    // Retrieve the file names associated with the record
    $getFilesSql = "SELECT copyright_material, copyright_certificate FROM `copyright` WHERE title = ?";
    $getFilesStmt = $conn->prepare($getFilesSql);
    $getFilesStmt->bind_param("i", $deleteTitle);
    $getFilesStmt->execute();
    $filesResult = $getFilesStmt->get_result();

    if ($filesRow = mysqli_fetch_assoc($filesResult)) {
        $materialFileToDelete = $filesRow['copyright_material'];
        $certificateFileToDelete = $filesRow['copyright_certificate'];

        // Delete the material file from the folder
        if (unlink("copyright/" . $materialFileToDelete)) {
            // Material file deleted successfully
        } else {
            echo "Error deleting material file.";
        }

        // Delete the certificate file from the folder
        if (unlink("copyright/" . $certificateFileToDelete)) {
            // Certificate file deleted successfully
        } else {
            echo "Error deleting certificate file.";
        }

        // Now, delete the record from the database
        $deleteSql = "DELETE FROM `copyright` WHERE title = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $deleteTitle);

        if ($deleteStmt->execute()) {
            // Record deleted successfully
            header("Location: dashboard.php");
        } else {
            echo "Error deleting record: " . $deleteStmt->error;
        }
    } else {
        echo "Files not found.";
    }
}

// Execute a SELECT query to retrieve the user's copyright submissions
$sql = "SELECT * FROM `copyright` WHERE sdrn_no = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $sdrn);
$stmt->execute();
$result = $stmt->get_result();

// Display the user's contributions in a table
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<thead><tr><th>Department</th><th>Title</th><th>Registration Date</th><th>Material</th><th>Certificate</th><th>Modify</th><th>Delete</th></tr></thead>";
    echo "<tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['department'] . "</td>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['pub_date'] . "</td>";
        echo "<td><a href='view_pdf.php?pdf=" . urlencode($row['copyright_material']) . "' target='_blank'>View</a></td>";
        echo "<td><a href='view_pdf.php?pdf=" . urlencode($row['copyright_certificate']) . "' target='_blank'>View</a></td>";
        echo '<td><a href="copyrightupdate.php?id=' . $row['id'] . '" target="_blank">Modify</a></td>';
        echo '<td><a href="?action=delete&title=' . $row['title'] . '">Delete</a></td>';
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p>No contributions found.</p>";
}
?>


</div>
</body>
</html>
The difference between require and include in PHP:

1. Error Handling

· require: If the file fails to load, execution stops and shows a fatal error.
· include: If the file fails to load, execution continues with just a warning.

2. Common Use Cases

· require: For essential files (configuration files, database connections).
  php
  require 'config.php';
  require 'database.php';
  
· include: For non-critical content that can be skipped (page headers, sidebars, footers).
  php
  include 'header.php';
  include 'sidebar.php';
  

3. Recommended Variations

· require_once: Ensures the file is loaded only once, stops on errors.
  php
  require_once 'functions.php';
  
· include_once: Ensures the file is loaded only once, continues on errors.

4. Quick Comparison

Scenario require include
File not found Script stops Script continues
Typical use Core files Template parts
Best practice Use _once version Use as needed

5. Practical Example

php
// Essential - app won't work without config
require 'config.php';

// Cosmetic - page can display without header
include 'header.php';

// Essential and should not be repeated
require_once 'database.php';

// Optional template part
include 'footer.php';
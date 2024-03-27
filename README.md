# Simple web crawler
This is a simple web crawler that crawls a website (https://yourpetpa.com.au) and saves the content of the website in a text file. The crawler is written in Python and uses the BeautifulSoup library to parse the HTML content of the website.

## Usage

To use the web crawler, you need to have php installed on your system. You can install php by running the following command:

For ubuntu:
```bash
sudo apt-get install php
```

For windows: make sure php path is added to the system environment variables.

To run the web crawler, you need to run the following command:

```bash
php crawler.php
```

The web crawler will crawl the website and save the content in a csv file named `data.csv`.
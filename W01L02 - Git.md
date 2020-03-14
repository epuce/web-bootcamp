### Docker setup
1. Download docker - [link](https://www.docker.com/products/docker-desktop)
    * For older operating systems, docker toolbox - [link](https://github.com/docker/toolbox/releases)

2. Create a map that will hold the docker setup, something like "web_bootcamp_env" (try not to use spaces and separate words with _)
    * Create an other folder under the one you just created now, something like "src"

3. Create a file in the first folder you created named "Docker", copy the content from the [link](https://raw.githubusercontent.com/epuce/web-bootcamp/improvements/local-env-setup/Dockerfile)
    * Replace "COPY ./src /var/www/html" the ./src part with the name of the second folder you created under the first one (where this files are, like "./myFolderName")

4. Create a file next to the first one named "docker-compose.yml", copy the content from [link](https://raw.githubusercontent.com/epuce/web-bootcamp/improvements/local-env-setup/docker-compose.yml)
    * replace the line under "volumes:" with "-/full/path/to/the/secondFolder", like "- C:\edmunds\Public\Public\web_bootcamp_dev:/var/www/html/"

5. Start the docker application by clicking on the icon of the program, if everything is ok then continue, if not, we are doomed :D (no, not for real)

6. Restart (or start) visual studio code

7. Open the terminal

8. with terminal "cd function", navigate to the first folder we created, or open the vscode in that folder and open terminal

9. Run "docker-compose up --build"

10. If not installed get the docker extension form the left setting block with for squares

11. In the same place get PHP debug extension for vscode (can be done later)

12. Create a file named index.html in the second folder you created, as some content to it

13. Open "localhost:8000" in the browser if you see the content, everything is working

14. access docker container console "docker exec -it apache_php bash -l"

15. run the command "ls", you should see index.html printed out, if not, something is not working

16. add PHP configuration file for vscode under debug section, settings, php (can be done later)

### Some know issues:
* Windows setup shows "forbidden" in the browser - allow access to disk C: under docker program settings

* command "ls" does not show the index.html file - be sure that the paths you stated under point 3. and 4. are correct

Step by step setup - [link](http://blog.adnansiddiqi.me/getting-started-with-docker/)

### Git Work flow

* If docker set up did not work download git locally on your machine

* Set up git account @ github.com

* Add the ssh key
    * log in to docker container "docker exec -it apache_php bash -l" or open the terminal it the docker set up was not successful 
    * run "ssh-keygen -t rsa -b 4096 -C "your_email@example.com" [link](https://help.github.com/en/github/authenticating-to-github/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent)
    * press enter on all the questions
    * run "eval "$(ssh-agent -s)"
    * run "ssh-add ~/.ssh/id_rsa"
    * copy all the content printed out "cat ~/.ssh/id_rsa.pub"
    * add the kay in github [link](https://github.com/settings/keys)

* Set global git parameters - user and password (if needed)
    * git config --global user.name "Vārds Uzvārds"
    * git config --global user.email e-pasts@domēns.com

* Create github page https://pages.github.com/
    * Repository name - username.github.io

* Create index file - index.html (add some content)

* Get local changes to master

    * git add . 
    * git commit -m "Your message"
    * git push origin master 

* Forking
    * choose the repository to get a private clone - fork button in GUI

* Team work
    * cd to the project folder
    * git checkout -b your branch name
    * perform steps from - Get local changes to master
    * open github.com, navigate to newly created branch
    * create pull (merge) request
    * resolve conflicts if needed

* Other commands
    * git log (looks at commit history on current branch)
    * git reflog (changes made on branch)
    * git diff (not staged file changes)
    * git status (look at files that hav changed)
    * git reset HEAD~1 (1 - commits to be reset, can use hash instead)
    * git checkout ./path/to/file.html (revert changes that are made to file)
    * git fetch (sync change references with origin)
    * git branch -d branch-name (use "origin branch-name" to delete git branch or "branch-name" to delete local one)

* Get latest changes
    * on top of your changes - git pull
    * on top of branch you are pulling from - git pull --rebase origin branch name

* .gitignore
    * file where we state the files, directories are stated to be ignored from git (cache, logs, packages)

### More about git

* Git tools (hooks)
    * Git actions can trigger different functions (builds, tests, audits, notifications)

* Articles / blog posts
    * git cheatsheet - [link](https://www.git-tower.com/blog/git-cheat-sheet/)
    * good work flow example - [link](https://dev.to/unseenwizzard/learn-git-concepts-not-commands-4gjc)
    * github page possibilities - [link](https://pages.github.com/)

### Git checkup
* Create new project
* Get it locally on your machine
* Create a new file
* Push two different commits to origin/master
* Create new branch based on current master
* Add one commit to newly created branch
* Push to newly created branch
* Create pull (merge) request and merge the changes
* Switch back to local master branch
* Get newly merged changes
* Push new commit to origin/master
### Docker setup
Under docker-compose.yml, if using linux, change to local ip under xdebug.remote_host
* Navigate to folder docker-env-setup
* "docker-compose up -d --build"
* get PHP debug extention for vscode
* add PHP configuartion file for vscode under debug section, settings, php
* access docker container console " docker exec -it apache_php bash -l"

* Step by step setup - [link](http://blog.adnansiddiqi.me/getting-started-with-docker/)
### Git Work flow

* Download git locally on your machine

* Set up git account @ github.com

* Set global git parameters - user and password (if needed)
    * git config --global user.name "Vārds Uzvārds"
    * git config --global user.email e-pasts@domēns.com

* Create github page https://pages.github.com/
    * Repository name - username.github.io

* Clone repository - git clone https://github.com/username/usernam.github.io.git

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

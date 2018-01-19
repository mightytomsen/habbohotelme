<?php

final class Forum {

    public $connection;

    public static $RANKS = [
        1 => ["name" => "Mitglied", "color" => "#4183D7"],
        2 => ["name" => "<span style='background: url(web-gallery/userbg.gif)center'>Hotelteam</span>", "color" => "rgba(217, 30, 24, 0.8);"]
    ];

    public function __construct() {
        $this->connection = new Connection(new MySQLi(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASSWORD, Config::MYSQL_DATABASE, Config::MYSQL_PORT));
    }

    public function loadEntries() {
        $query = $this->connection->query('SELECT * FROM forum ORDER BY id DESC');

        $topics = [];
        $topics["community"] = [];
        $topics["announcement"] = [];

        while ($row = $query->fetch_assoc()) {
            $topics[$row["type"]][] = $row;
        }

        return $topics;
    }
	
	public function editPermission_thread($id) {
		if($this->existsTopic($id)) {
			$results = $this->connection->query('SELECT * FROM forum WHERE id = :id AND username = :username', [
				"id" => $id,
				"username" => $_SESSION['username']
			])->num_rows;
			
			if($results) {
				return true;
			} else {
				$results = $this->connection->query('SELECT * FROM users WHERE username = :username', [
					"username" => $_SESSION['username']
				])->fetch_assoc();
				
				$ranks = explode(";", $results['rank']);
				
				if(in_array(2, $ranks)) {
					return true;
				}
				
			}
		}
		
		return false;
	}

	public function hasAdmin($username) {
		$query = $this->connection->query('SELECT * FROM users WHERE username = :user', [
			"user" => $username
		])->fetch_assoc();

		$ranks = explode(";", $query['rank']);

		if(in_array(2, $ranks)) {
			return true;
		}

		return false;
	}
	
	public function editPermission_post($id) {
		if($this->existsPost($id)) {
			$results = $this->connection->query('SELECT * FROM posts WHERE id = :id AND username = :username', [
				"id" => $id,
				"username" => $_SESSION['username']
			])->num_rows;
			
			if($results) {
				return true;
			} else {
				$results = $this->connection->query('SELECT * FROM users WHERE username = :username', [
					"username" => $_SESSION['username']
				])->fetch_assoc();
				
				$ranks = explode(";", $results['rank']);
				
				if(in_array(2, $ranks)) {
					return true;
				}
				
			}
		}
		
		return false;
	}

    public function existsTopic($id) {
        $results = $this->connection->query('SELECT * FROM forum WHERE id = :id', [
                    "id" => $id
                ])->num_rows;

        if ($results) {
            return true;
        }

        return false;
    }
	
	public function existsPost($id) {
        $results = $this->connection->query('SELECT * FROM posts WHERE id = :id', [
                    "id" => $id
                ])->num_rows;

        if ($results) {
            return true;
        }

        return false;
    }

    public function loadTopic($id) {
		if($this->existsTopic($id)) {
			$query = $this->connection->query('SELECT * FROM forum WHERE id = :id', [
				"id" => $id
			]);
	
			$data = [];
	
			while ($row = $query->fetch_assoc()) {
				array_push($data, $row);
			}
	
			return $data;
		}
		
		return false;
    }
	
	public function loadPost($id) {
		if ($this->existsPost($id)) {
			$data = $this->connection->query('SELECT * FROM posts WHERE id = :id', [
				"id" => $id
			])->fetch_assoc();
	
			return $data;
		}
		
		return false;
    }
	
    public function createTopic($title, $content, $username, $type = "community") {
    	$user = new User();

    	$this->connection->query('INSERT INTO forum (title, content, username, type, avatar) VALUES (:title, :content, :username, :type, :avatar)', [
    		"title" => $title,
    		"content" => $content,
    		"username" => $username,
    		"type" => $type,
    		"avatar" => $user->getUserinfo($username, "avatar")
    	]);
    }

	public function loadPostdata($id, $type) {
		if($type == "thread") {
			if($this->existsTopic($id)) {
				$data = $this->connection->query('SELECT * FROM forum WHERE id = :id', [
					"id" => $id
				])->fetch_assoc();
				return $data;
			}
		} else {
			if($this->existsPost($id)) {
				$data = $this->connection->query('SELECT * FROM posts WHERE id = :id', [
					"id" => $id
				])->fetch_assoc();
				return $data;
			}
		}
		
		return false;
    }

    public function showthread_popup($id) {
        return $this->loadTopic($id);
    }

    public function comment($comment, $username, $avatar, $forumid){
        if(!empty($comment)){
            $comment = $this->connection->query("INSERT INTO posts (content, username, avatar, thread_id, date) VALUES (:content, :username, :avatar, :id, :date)", [
                "content" => htmlspecialchars($comment),
                "username" => $username,
                "avatar" => $avatar,
                "id" => $forumid,
                "date" => date("d.m.Y")
            ]);
        }
    }

    public function loadComment($id){

        $loadComment = $this->connection->query("SELECT * FROM posts WHERE thread_id = :id", [
           "id" => $id
        ]);

        $data = [];

        while($row = $loadComment->fetch_assoc()){
            array_push($data, $row);
        }

        return $data;

    }

    public function editPost($id, $type, $content){
        if($type == "thread") {
			$this->connection->query('UPDATE forum SET content = :content WHERE id = :id', [
				"id" => $id,
				"content" => $content
			]);
		} else {
			$this->connection->query('UPDATE posts SET content = :content WHERE id = :id', [
				"id" => $id,
				"content" => $content
			]);
		}
    }
    
    public function closeTopic($id) {
    	$this->connection->query("UPDATE forum SET close = :status WHERE id = :id", [
            "id" => $id,
            "status" => "1"
        ]);
    }
    
}

<?php
    namespace app\models;
    use app\core\DbModel;

    class Comment extends DbModel {

        public int $product_id;
        public int $user_id;
        public int $is_answer;
        public string $content;
        public ?int $answer_id;
        public function rules(): array {
            return [
                'comment_id' => [self::RULE_UNIQUE, self::RULE_REQUIRED],
                'product_id' => [self::RULE_REQUIRED],
                'user_id' => [self::RULE_REQUIRED],
                'is_answer' => [self::RULE_REQUIRED],
            ];
        }
        public static function tableName(): string {
            return 'comments';
        }
        public static function attribute(): array {
            return ['product_id', 'user_id', 'is_answer', 'content', 'answer_id'];
        }
        public static function primaryKey(): string {
            return 'comment_id';
        }
        public static function userRole(): string {
            return '';
        }

        public function getRecentComment(int $product_id) {
            $sql_command = self::prepare("SELECT users.fullname, comments.comment_id, comments.is_answer, comments.answer_id, comments.content, comments.created_at
                FROM comments JOIN users ON comments.user_id = users.id WHERE comments.product_id = $product_id AND comments.is_answer = 1 ORDER BY created_at DESC LIMIT 5;");
            $sql_command->execute();
            $questions = $sql_command->fetchAll();
            $comments = array();
            foreach ($questions as $question) {
                array_push($comments, $question);
                $sql_command = self::prepare("SELECT users.fullname, comments.is_answer, comments.answer_id, comments.content, comments.created_at
                FROM comments JOIN users ON comments.user_id = users.id WHERE comments.answer_id = $question[comment_id] ORDER BY created_at ASC;");
                $sql_command->execute();
                $answers = $sql_command->fetchAll();
                foreach ($answers as $answer) { array_push($comments, $answer); }
                array_push($comments, "comment-$question[comment_id]");
            }
            return $comments;
        }

        public function createComment(int $product_id, int $user_id, int $is_answer, string $content, int $answer_id) {
            $this->product_id = $product_id;
            $this->user_id = $user_id;
            $this->is_answer = $is_answer;
            $this->content = $content;
            $this->answer_id = $answer_id === 0 ? NULL : $answer_id;
            return $this->save();
        }
    }
?>
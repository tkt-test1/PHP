<?php
/**
 * Trie（前方一致検索木）の実装サンプル
 * 
 * - 単語の登録
 * - 単語の検索
 * - 前方一致検索
 */

class TrieNode {
    public $children = [];
    public $isEndOfWord = false;
}

class Trie {
    private $root;

    public function __construct() {
        $this->root = new TrieNode();
    }

    // 単語を挿入
    public function insert(string $word): void {
        $node = $this->root;
        for ($i = 0; $i < strlen($word); $i++) {
            $ch = $word[$i];
            if (!isset($node->children[$ch])) {
                $node->children[$ch] = new TrieNode();
            }
            $node = $node->children[$ch];
        }
        $node->isEndOfWord = true;
    }

    // 単語の完全一致検索
    public function search(string $word): bool {
        $node = $this->root;
        for ($i = 0; $i < strlen($word); $i++) {
            $ch = $word[$i];
            if (!isset($node->children[$ch])) {
                return false;
            }
            $node = $node->children[$ch];
        }
        return $node->isEndOfWord;
    }

    // 前方一致検索
    public function startsWith(string $prefix): bool {
        $node = $this->root;
        for ($i = 0; $i < strlen($prefix); $i++) {
            $ch = $prefix[$i];
            if (!isset($node->children[$ch])) {
                return false;
            }
            $node = $node->children[$ch];
        }
        return true;
    }
}

// ===== サンプル実行 =====
$trie = new Trie();
$trie->insert("apple");
$trie->insert("app");
$trie->insert("application");

echo "Search 'app': " . ($trie->search("app") ? "true" : "false") . PHP_EOL;        // true
echo "Search 'appl': " . ($trie->search("appl") ? "true" : "false") . PHP_EOL;      // false
echo "StartsWith 'appl': " . ($trie->startsWith("appl") ? "true" : "false") . PHP_EOL; // true

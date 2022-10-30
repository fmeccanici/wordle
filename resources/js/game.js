import Tile from './Tile';
import {allWords, theWords} from './words';

export default {

    // TODO: Use different files for threeLetter.js fourLetter.js
    theWord: theWords[Math.floor(Math.random() * theWords.length)],
    guessesAllowed: 3,
    currentRowIndex: 0,
    state: 'active',
    message: '',
    errors: false,

    // TODO: Move to keyboard component
    letters: [
        'QWERTYUIOP'.split(''),
        'ASDFGHJKL'.split(''),
        ['Enter', ...'ZXCVBNM'.split(''), 'Backspace']
    ],

    get currentGuess() {
        return this.currentRow.map(tile => tile.letter).join('');
    },

    get currentRow() {
        return this.board[this.currentRowIndex];
    },

    get remainingGuesses() {
        return this.guessesAllowed - this.currentRowIndex - 1;
    },

    init() {
        this.board = Array.from({length: this.guessesAllowed}, () => {
            return Array.from({length: this.theWord.length}, (item, index) => new Tile(index));
        });
    },
    matchingTileForKey(key) {
        return this.board
            .flat()
            .filter((tile) => tile.status)
            .sort((t1, t2) => t2.status === 'correct' ? 1 : -1)
            .find((tile) => tile.letter === key.toLowerCase());
    },
    onKeyPress(key) {
        this.message = '';
        this.errors = false;

        if (/^[A-z]$/.test(key)) {
            this.fillTile(key);
        } else if (key === 'Backspace') {
            this.emptyTile();
        } else if (key === 'Enter') {
            this.submitGuess();
        }
    },
    fillTile(key) {
        for (let tile of this.currentRow) {
            if (!tile.letter) {
                tile.fill(key);
                break;
            }
        }
    },
    emptyTile() {
        for (let tile of [...this.currentRow].reverse()) {
            if (tile.letter) {
                tile.empty();
                break;
            }
        }
    },
    submitGuess() {
        if (this.currentGuess.length < this.theWord.length) {
            return;
        }

        if (!allWords.includes(this.currentGuess.toUpperCase())) {
            this.errors = true;
             this.message = 'Invalid word...';
             return;
        }

        // TODO: Implement dictionary API
        // if (! await this.checkDictionary(this.currentGuess))
        // {
        //
        // }
        // for (let tile of this.currentRow) {
        //     tile.updateStatus(this.currentGuess, this.theWord);
        // }

        Tile.updateStatusesForRow(this.currentRow, this.theWord);

        this.currentRow.forEach((tile, index) => {
            if (tile.status !== 'present') return;

            if (this.currentRow.some(t => t.letter === tile.letter && t.status === 'correct')) {
                tile.status = 'absent';
            }
        });

        if (this.currentGuess === this.theWord) {
            this.state = 'complete';
            this.message = 'You Win!';
        } else if (this.remainingGuesses === 0) {
            this.state = 'complete';
            this.message = 'Game Over. You Lose!';
        } else {
            this.currentRowIndex++;
            this.message = 'Incorrect';
        }

    },
};

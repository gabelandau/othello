import store from '../store'
import axios from 'axios'

export const addPiece = (x, y, color, game) => {
  let currentPieces = store.getters.getPieces

  if (validatePiece(x, y, color, currentPieces)) {
    axios.post(`/game/${game}/addPiece`, { x, y, color }).then((res) => console.log(res)).catch((err) => console.log(err))
  }
}

function validatePiece (x, y, color, pieces) {
  let right = checker(x, y, color, pieces, { x: 1, y: 0, direction: 1 }, 'x')
  let left = checker(x, y, color, pieces, { x: -1, y: 0, direction: -1 }, 'x')
  let down = checker(x, y, color, pieces, { x: 0, y: 1, direction: 1 }, 'y')
  let up = checker(x, y, color, pieces, { x: 0, y: -1, direction: -1 }, 'y')
  if (right || left || down || up) return true
  return false
}

function checker (x, y, color, pieces, direction, axis) {
  let cx = x
  let cy = y

  // Check adjacent it exists and is not the same color
  let test = pieces[`${cx + direction.x}${cy + direction.y}`]
  if (!test || test.color === color) return false

  // Check the rest of the pieces
  while (true) {
    if (axis === 'x') {
      cx += direction.direction
    } else if (axis === 'y') {
      cy += direction.direction
    } else if (axis === 'both') {
      cx += direction.direction
      cy += direction.direction
    }

    test = pieces[`${cx + direction.x}${cy + direction.y}`]

    // If the next piece is null, return invalid
    if (!test) return false

    // If the next piece is the same color, return true and make a move
    if (test.color === color) return true

    // Sanity check, can't look for pieces with an x or y greater than 8
    if (cx > 8 || cx < 0 || cy > 8 || cy < 0) break
  }

  // If you get here, something is wrong so return false
  return false
}

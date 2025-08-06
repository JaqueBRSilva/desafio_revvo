import { BrowserRouter, Route, Routes } from 'react-router'
import Error404 from './pages/Error404/Error404'
import Home from './pages/Home/Home'

function App() {

  return (
    <BrowserRouter>
      <Routes>
        <Route path='/' element={<Home />} />
        <Route path='*' element={<Error404 />} />
      </Routes>
    </BrowserRouter>
  )
}

export default App

import createLogger from 'redux-logger';
import thunkMiddleware from 'redux-thunk';
import { createStore, applyMiddleware, compose } from 'redux';
import { routerMiddleware } from 'react-router-redux';
import { browserHistory } from 'react-router';
// import eventHandler from 'opifer-rcs/src/middleware/events';
import reducer from './reducer';

const loggerMiddleware = createLogger();

const store = createStore(
  reducer,
  compose(
    applyMiddleware(
      thunkMiddleware,
      // eventHandler,
      loggerMiddleware,
      routerMiddleware(browserHistory)
    ),
    window.devToolsExtension ? window.devToolsExtension() : f => f
  )
);

export default store;

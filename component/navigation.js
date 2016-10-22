var Navigation = React.createClass({
  render: function() {
    return (  <div className="navbar navbar-default navbar-fixed-top">
                <div className="container">
                  <div className="navbar-header">
                    <a href="/" className="navbar-brand">Planner
                    </a>
                    <button className="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                      <span className="icon-bar"></span>
                      <span className="icon-bar"></span>
                      <span className="icon-bar"></span>
                    </button>
                  </div>
                  <div className="navbar-collapse collapse" id="navbar-main">
                    <ul className="nav navbar-nav">
                      <li className="dropdown">
                      <a className="dropdown-toggle" data-toggle="dropdown" href="#">Budget
                        <span className="caret"></span>
                      </a>
                        <ul className="dropdown-menu">
                          <li>
                            <a href="/budget">Home</a>
                          </li>
                          <li>
                            <a href="#">Monthly Plan</a>
                          </li>
                          <li>
                            <a href="/budget/transaction">Transactions</a>
                          </li>
                          <li>
                            <a href="#">Summaries</a>
                          </li>
                          <li>
                            <a href="#">Calculator</a>
                          </li>
                          <li>
                            <a href="#">History</a>
                          </li>
                        </ul>
                      </li>
                      <li>
                        <a href="#">To Do List</a>
                      </li>
                      <li>
                        <a href="#">Tracker</a>
                      </li>
                      <li>
                        <a href="#">Wish List</a>
                      </li>
                      <li>
                        <a href="#"><i className="fa fa-cog fa-1" aria-hidden="true"></i></a>
                      </li>
                  </ul>
                </div>
              </div>
            </div>
        );
  }
});

var navigation = document.getElementById('navigation');

ReactDOM.render(<Navigation />, navigation);

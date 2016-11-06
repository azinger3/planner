var BudgetNavigation = React.createClass({
  render: function() {
    return (  <div className="navbar navbar-default navbar-fixed-top">
                <div className="container">
                  <div className="navbar-header">
                    <a href="/budget" className="navbar-brand">Budget
                    </a>
                    <button className="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                      <span className="icon-bar"></span>
                      <span className="icon-bar"></span>
                      <span className="icon-bar"></span>
                    </button>
                  </div>
                  <div className="navbar-collapse collapse" id="navbar-main">
                    <ul className="nav navbar-nav">
                      <li>
                        <a href="#">Plan</a>
                      </li>
                      <li>
                        <a href="/budget/transaction">Transactions</a>
                      </li>
                      <li>
                        <a href="/budget/summary">Summary</a>
                      </li>
                      <li>
                        <a href="#">Calculator</a>
                      </li>
                      <li>
                        <a href="http://jordanandrobert.com/budget">History</a>
                      </li>
                      <li>
                        <a href="#">Admin</a>
                      </li>
                  </ul>
                  <ul className="nav navbar-nav navbar-right">
                    <li>
                      <a href="/"><small>Planner</small>&nbsp;&nbsp;<i className="fa fa-caret-right plannerBackArrow" aria-hidden="true"></i></a>
                    </li>
                </ul>
                </div>
              </div>
            </div>
        );
  }
});

var budgetNavigation = document.getElementById("budgetNavigation");

ReactDOM.render(<BudgetNavigation />, budgetNavigation);

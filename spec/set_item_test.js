describe("set_item> ", function(){
	describe("select_person_cnt> ", function(){
		beforeEach(function(){
			spyOn(console, "log");
			localStorage.clear();

			$('body').append("<div id='test'></div>");
		});

		//候補者が3人未満の場合のテストコード。
		it("under_3", function(){
			var selected_json = {
				contender3:"333",
				contender5:"555"
			};
			var voter_info = {voter_id : "test"};
			$('#test').append('<input type="hidden" id="jsform_checkbox2" data-candidate-id="A1-1" data-candidate-title="AAA" data-candidate-name="AAA">');
			$('#test').append('<input type="hidden" id="jsform_checkbox4" data-candidate-id="A1-2" data-candidate-title="AAA" data-candidate-name="AAA">');
			localStorage.setItem('voter_info', JSON.stringify(voter_info));
			localStorage.setItem('Candidate_ID',JSON.stringify(selected_json));
			set_item();
			expect(console.log).toHaveBeenCalledWith("count < 3");
		});

		//候補者が4人の場合のテストコード。
		it("greater_3", function(){
			var selected_json = {
				contender3:"333",
				contender4:"444",
				contender5:"555",
				contender1:"111"
			};
			var voter_info = {voter_id : "test"};
			$('#test').append('<input type="hidden" id="jsform_checkbox2" data-candidate-id="A1-1" data-candidate-title="AAA" data-candidate-name="AAA">');
			$('#test').append('<input type="hidden" id="jsform_checkbox3" data-candidate-id="A1-2" data-candidate-title="AAA" data-candidate-name="AAA">');
			$('#test').append('<input type="hidden" id="jsform_checkbox4" data-candidate-id="A1-3" data-candidate-title="AAA" data-candidate-name="AAA">');
			$('#test').append('<input type="hidden" id="jsform_checkbox0" data-candidate-id="A1-4" data-candidate-title="AAA" data-candidate-name="AAA">');
			localStorage.setItem('voter_info', JSON.stringify(voter_info));
			localStorage.setItem('Candidate_ID',JSON.stringify(selected_json));
			set_item();
			expect(console.log).toHaveBeenCalledWith("count > 3");
		});

		it("get-param is nothing", function() {
			var voter_info = null;
			localStorage.setItem('voter_info', voter_info);
			set_item();
			expect(console.log).toHaveBeenCalledWith("get-param is error");
		});
	});
});
